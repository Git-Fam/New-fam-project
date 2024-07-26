$(function(){

  // バーガー
    $(".menu-trigger").on("click", function(){
      $("body,.menu-trigger,.header--content--menu,.back").toggleClass("active");
    });


  // ×&リンク以外クリックしたらメニューを閉じる

    $(".back").on("click", function(){
      $("body,.menu-trigger,.header--content--menu,.back").removeClass("active");
    });



    // ページトップへ戻るボタンが表示される
    window.addEventListener('scroll', function() {
      const pageTopLink = document.querySelector('.page__top');
      
      if (window.scrollY >= 800) {
        pageTopLink.style.display = 'block';
      } else {
        pageTopLink.style.display = 'none';
      }
    });

  

// videoタグとbuttonタグを変数に格納
// const video = document.getElementById('video');
// const videoButton = document.getElementById('on-off');

// // mutedを操作する関数を定義
// const toggleAudio = () => {
//     video.muted = !video.muted;;
// }

// videoButton.addEventListener('click', () => {
//     // 関数を実行
//     toggleAudio();

//     // テキストを操作
//     if (videoButton.textContent === '音声をonにする') {
//         videoButton.textContent = '音声をoffにする';
//         videoButton.classList.add('active');
//     } else {
//         videoButton.textContent = '音声をonにする';
//         videoButton.classList.remove('active');
//     }
// });



    // タブの切り替え
    $(document).ready(function() {
      $('.click--point').click(function() {
        $('.click--point').removeClass('active');
        $(this).addClass('active');
        
        const targetIndex = $(this).index();
        $('.click--contents').removeClass('active');
        $('.click--contents').eq(targetIndex).addClass('active');
        const targetIdex = $(this).index();
        $('.click--contents--sp').removeClass('active');
        $('.click--contents--sp').eq(targetIdex).addClass('active');
      });
    });

    // アコーディオン
    $(document).ready(function() {
      $('.attempt__action__contents__run__item').click(function() {
        $(this).find('img').toggleClass('active');
        $(this).siblings('.attempt__action__contents__run__text').toggleClass('active');
      });
    });
    


    // カンパニーページ
      // content--item p の中身がない場合は、content--item p とcontent--item のタグごと削除
      $('.content--item p').each(function(){
        if($(this).html() == ''){
          $(this).parents('.content--item').remove();
        }
      });

      // .history__img--section__boxにpタグとimgタグがない場合は、.history__img--section__boxのタグごと削除
      $('.history__img--section__box').filter(function() {
        return $(this).find('p').html() == '' || $(this).find('img').attr('src') == '';
      }).remove();

      // trac--content--item--title p、containerIn img 、containerIn p の中身がない場合は、ttrac--content--itemタグごと削除
      $('.trac--content--item--title p').each(function(){
        if($(this).html() == ''){
          $(this).parents('.trac--content--item').remove();
        }
      });
      $('.containerIn img').each(function(){
        if($(this).attr('src') == ''){
          $(this).parents('.trac--content--item').remove();
        }
      });
      $('.containerIn p').each(function(){
        if($(this).html() == ''){
          $(this).parents('.trac--content--item').remove();
        }
      });

      // container--list li p の中身がない場合は、container--list liタグごと削除
      $('.container--list li p').each(function(){
        if($(this).html() == ''){
          $(this).parents('li').remove();
        }
      });
      

      // certificate__certification__section__contents p,certificate__certification__section__contents img の中身がない場合は、certificate__certification__section__contentsタグごと削除
      $('.certificate__certification__section__contents p').each(function(){
        if($(this).html() == ''){
          $(this).parents('.certificate__certification__section__contents').remove();
        }
      });
      $('.certificate__certification__section__contents img').each(function(){
        if($(this).attr('src') == ''){
          $(this).parents('.certificate__certification__section__contents').remove();
        }
      });


      // attempt__action__contents__run__item__title p、attempt__action__contents__run__text p、attempt__action__contents__run__itemのスタイルにbackground-imageがない場合は、attempt__action__contents__runを削除
      $('.attempt__action__contents__run__item__title p').each(function(){
        if($(this).html() == ''){
          $(this).parents('.attempt__action__contents__run').remove();
        }
      });
      $('.attempt__action__contents__run__text p').each(function(){
        if($(this).html() == ''){
          $(this).parents('.attempt__action__contents__run').remove();
        }
      });
      $('.attempt__action__contents__run__item').each(function(){
        if($(this).css('background-image') == 'none'){
          $(this).parents('.attempt__action__contents__run').remove();
        }
      });

      
      // container--item" text p の中身がない場合は、container--itemタグごと削除
      $('.container--item p').each(function(){
        if($(this).html() == ''){
          $(this).parents('.container--item').remove();
        }
      });

      //会社沿革アイコンクリックで写真表示
      $('.icon').click(function(){
        $(this).next().slideToggle();
        $(this).toggleClass('show');
      });

      


  
      
    });


