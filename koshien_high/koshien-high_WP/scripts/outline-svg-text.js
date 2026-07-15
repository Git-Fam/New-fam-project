const fs = require('fs');
const path = require('path');
const opentype = require('opentype.js');

const fontPath = '/tmp/ZenKakuGothicNew-Medium.ttf';
const svgDir = path.join(__dirname, '../img/junior-admission');
const files = fs
  .readdirSync(svgDir)
  .filter((f) => f.startsWith('junior-admission-student-btn-') && f.endsWith('.svg'));

const font = opentype.parse(fs.readFileSync(fontPath));

const textOffsets = {
  pc: {
    'WEB出願': -36.92,
    '合否照会': -35.36,
    '入学手続き': -44.48,
  },
  sp: {
    'WEB出願': -32.305,
    '合否照会': -30.94,
    '入学手続き': -38.92,
  },
};

function round2(value) {
  return Math.round(value * 100) / 100;
}

function buildPath(text, x, y, fontSize, letterSpacingEm) {
  const spacing = fontSize * letterSpacingEm;
  let currentX = round2(x);
  const parts = [];

  for (let i = 0; i < text.length; i++) {
    const char = text[i];
    const glyph = font.charToGlyph(char);
    if (!glyph) continue;

    parts.push(glyph.getPath(currentX, y, fontSize).toPathData(2));
    currentX = round2(currentX + font.getAdvanceWidth(char, fontSize));
    if (i < text.length - 1) {
      currentX = round2(currentX + spacing);
    }
  }

  return parts.join(' ');
}

function outlineTextInSvg(content, file) {
  const sizeKey = file.includes('-sp.') ? 'sp' : 'pc';
  const fontSize = sizeKey === 'sp' ? 14 : 16;
  const letterSpacingEm = 0.14;

  const textRegex =
    /<text\b([^>]*)><tspan\b[^>]*x="([^"]*)"[^>]*y="([^"]*)"[^>]*>([^<]*)<\/tspan><\/text>/g;

  const pathRegex =
    /<path id="([^"]+)" transform="translate\(([-\d.]+)\s+([-\d.]+)\)" fill="([^"]*)" d="[^"]*"\/>/g;

  const replaceWithPath = (text, attrsOrTransform, tspanX, tspanY, fill) => {
    const x = round2(Number(tspanX));
    const y = Number(tspanY);
    const pathData = buildPath(text, x, y, fontSize, letterSpacingEm);

    if (pathData.includes('NaN')) {
      throw new Error(`NaN found in path for "${text}" in ${file}`);
    }

    if (typeof attrsOrTransform === 'string' && attrsOrTransform.includes('transform')) {
      const transformMatch = attrsOrTransform.match(/transform="translate\(([-\d.]+)\s+([-\d.]+)\)"/);
      const idMatch = attrsOrTransform.match(/id="([^"]*)"/);
      const fillMatch = attrsOrTransform.match(/fill="([^"]*)"/);
      const id = idMatch ? ` id="${idMatch[1]}"` : ` id="${text}"`;
      const fillColor = fillMatch ? fillMatch[1] : fill;
      return `<path${id} transform="translate(${transformMatch[1]} ${transformMatch[2]})" fill="${fillColor}" d="${pathData}"/>`;
    }

    return `<path id="${text}" transform="translate(${attrsOrTransform} ${tspanY})" fill="${fill}" d="${pathData}"/>`;
  };

  let result = content.replace(textRegex, (match, attrs, tspanX, tspanY, text) =>
    replaceWithPath(text, attrs, tspanX, tspanY)
  );

  result = result.replace(pathRegex, (match, text, translateX, translateY, fill) => {
    const tspanX = textOffsets[sizeKey][text];
    if (tspanX === undefined) return match;
    return replaceWithPath(text, translateX, tspanX, 0, fill);
  });

  return result;
}

files.forEach((file) => {
  const filePath = path.join(svgDir, file);
  const original = fs.readFileSync(filePath, 'utf8');
  const outlined = outlineTextInSvg(original, file);

  if (outlined === original) {
    console.error(`No changes in ${file}`);
    process.exitCode = 1;
    return;
  }

  fs.writeFileSync(filePath, outlined);
  console.log(`Outlined: ${file}`);
});
