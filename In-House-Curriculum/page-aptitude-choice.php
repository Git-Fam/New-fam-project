<?php get_header();?>
	<div class="aptitude-choice">
		<div class="aptitude-choice__inner">
			<div class="choice--area">
				<div class="choice--item choice--item--engineer">
					<div class="choice--item--title">
						<p class="TL">
							<img src="<?php echo get_template_directory_uri(); ?>/img/aptitude-choice-engineer.png" alt="エンジニア">
						</p>
					</div>
					<div class="choice--item--img img-engineer">
						<div class="icon-star"></div>
					</div>
				</div>
				<div class="choice--item choice--item--designer">
					<div class="choice--item--title">
						<p class="TL">
							<img src="<?php echo get_template_directory_uri(); ?>/img/aptitude-choice-designer.png" alt="デザイナー">
						</p>
					</div>
					<div class="choice--item--img img-designer">
						<div class="icon-star"></div>
					</div>
				</div>
			</div>
			<div class="character--area">
				<div class="character--message">
					<div class="character--message--inner">
						<p class="TX no-choice">
							適性検査を受けに来たんだね！<br>
							今からぼくが、きみの可能性をズバっと見抜いちゃうよ<br>
							さっそく質問だよ！きみがなりたいと思ってるのはどっちかな？
						</p>
						<p class="TX TX-engineer">
							なるほど！<br>
							きみはエンジニアになりたいんだね！<br>
							エンジニア用の適性検査をはじめるよ！
						</p>
						<p class="TX TX-designer">
							なるほど！<br>
							きみはデザイナーになりたいんだね！<br>
							デザイナー用の適性検査をはじめるよ！
						</p>
					</div>
					<a href="<?php bloginfo('url'); ?>/aptitude-engineer" class="btn engineer-btn">
						<div class="btn-arrow"></div>
					</a>
					<a href="<?php bloginfo('url'); ?>/aptitude-designer" class="btn designer-btn">
						<div class="btn-arrow"></div>
					</a>
				</div>
				<div class="character--texture">
					<div class="img"></div>
				</div>
			</div>
		</div>
	</div>
	<?php get_footer(); ?>