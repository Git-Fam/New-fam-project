
cooperator
用意済み
ディレクトリ内なら、自由にカスタム可能

    cooperator
      ├ globalCooperator
      |    └_ex_mixins.scss
      |    └ _ex_variables.scss
      |    └ _index.scss
      |       ↑独自の変数とか、mixinとかを入れるディレクトリ
      |
      ├pageCooperator
      |    └ _example.scss
      |    └ _index.scss
      |       ↑ページごとのスタイルを入れるディレクトリ
      |
      ├componentsCooperator
      |     └ _C_example.scss
      |     └ _index.scss
      |       ↑コンポーネントごとのスタイルを入れるディレクトリ
      |
      └  _index.scss


scssファイルを増やす時、それぞれの_index.scssにforwardしないと恐らくエラー起きます。

元からあるmixinsや変数はglobalに入っています。
自由に使ってください。編集はしないでください。