@charset "UTF-8";
/* -----------------------
リセット
----------------------- */
html, body, h1, h2, h3, h4, ul, ol, dl, li, dt, dd, p, div, span, img, a, table, tr, th, td {
  margin: 0;
  padding: 0;
  border: 0;
  vertical-align: baseline;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  list-style: none;
  overflow-wrap: break-word;
  word-break: break-all;
}

h1, h2, h3, h4 {
  text-align: left;
}

article, header, footer, aside, figure, figcaption, nav, section {
  display: block;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

section {
  margin: 0;
}

body {
  line-height: 1;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
}

ol, ul {
  list-style: none;
  list-style-type: none;
}

button {
  background: none;
  border: none;
  outline: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
}

a {
  text-decoration: none;
}

img {
  display: block;
}

/* -----------------------
  unity
----------------------- */
@media screen and (min-width: 768px) {
  .sp {
    display: none !important;
  }
}

@media screen and (max-width: 767px) {
  .pc {
    display: none !important;
  }
}

@media screen and (min-width: 768px) {
  .pc-inline {
    display: inline !important;
  }
}
@media screen and (max-width: 767px) {
  .pc-inline {
    display: none !important;
  }
}

html {
  scroll-behavior: smooth;
  scroll-padding-top: 10%;
}

body {
  font-family: "yu-gothic-pr6n", sans-serif;
  font-weight: 400;
  font-style: normal;
}
@media screen and (max-width: 767px) {
  body.active {
    overflow: hidden;
  }
}

.whopper {
  overflow: hidden;
}

@media screen and (min-width: 768px) {
  .template_wrap {
    padding-top: 100px;
  }
}
@media screen and (max-width: 767px) {
  .template_wrap {
    padding-top: 40px;
  }
}

@media screen and (min-width: 768px) {
  .template_inner880 {
    max-width: 880px;
    width: 90%;
    margin: 0 auto;
  }
}

@media screen and (min-width: 768px) {
  .template_inner1080 {
    max-width: 1080px;
    width: 90%;
    margin: 0 auto;
  }
}

@media screen and (min-width: 768px) {
  .cartNav {
    display: flex !important;
  }
}

/* -----------------------
  anime
----------------------- */
.hover-opa {
  transition: 0.3s;
}
.hover-opa:hover {
  opacity: 0.6;
}

.hover-scale {
  transition: 0.3s;
}
.hover-scale:hover {
  transform: scale(1.05);
}

.up {
  opacity: 0;
  transform: translateY(100%);
}
.up.show {
  animation: up 0.5s ease forwards;
}
@keyframes up {
  0% {
    opacity: 0;
    transform: translateY(100%);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

.delay-01 {
  animation-delay: 0.1s !important;
}

.delay-02 {
  animation-delay: 0.2s !important;
}

.delay-03 {
  animation-delay: 0.3s !important;
}

.delay-04 {
  animation-delay: 0.4s !important;
}

.delay-05 {
  animation-delay: 0.5s !important;
}

.delay-06 {
  animation-delay: 0.6s !important;
}

.delay-07 {
  animation-delay: 0.7s !important;
}

.delay-08 {
  animation-delay: 0.8s !important;
}

.delay-09 {
  animation-delay: 0.9s !important;
}

.delay-10 {
  animation-delay: 1s !important;
}

.delay-15 {
  animation-delay: 1.5s !important;
}

.duration-01 {
  animation-duration: 0.1s !important;
}

.duration-02 {
  animation-duration: 0.2s !important;
}

.duration-03 {
  animation-duration: 0.3s !important;
}

.duration-04 {
  animation-duration: 0.4s !important;
}

.duration-05 {
  animation-duration: 0.5s !important;
}

.duration-06 {
  animation-duration: 0.6s !important;
}

.duration-07 {
  animation-duration: 0.7s !important;
}

.duration-08 {
  animation-duration: 0.8s !important;
}

.duration-09 {
  animation-duration: 0.9s !important;
}

.duration-10 {
  animation-duration: 1s !important;
}

.duration-15 {
  animation-duration: 1.5s !important;
}

/* -----------------------
  header
----------------------- */
#header {
  background-color: #FFF;
}
#header .container {
  max-width: unset !important;
  padding-right: 0 !important;
}
@media screen and (max-width: 767px) {
  #header .header_top_inner {
    padding-right: unset;
    padding-block: unset;
    max-width: unset;
    min-height: unset;
  }
}
#header .logo {
  font-weight: 600;
  line-height: 1.5;
}
@media screen and (min-width: 768px) {
  #header .logo {
    font-size: 4rem;
  }
}
@media screen and (max-width: 767px) {
  #header .logo {
    font-size: 2.4rem;
  }
}
#header .logo a {
  display: block;
}
#header .logo img {
  width: 100%;
}
@media screen and (min-width: 768px) {
  #header .logo img {
    max-width: min(300px, 50vw);
  }
}
@media screen and (max-width: 767px) {
  #header .logo img {
    max-width: min(142px, 36.4102564103vw);
  }
}
@media screen and (max-width: 767px) {
  #header .cartNav {
    padding-right: unset;
  }
}
#header .cartNav .header_icon {
  padding-inline: unset;
  aspect-ratio: 1;
  position: relative;
}
@media screen and (min-width: 768px) {
  #header .cartNav .header_icon {
    width: 100px;
  }
}
@media screen and (max-width: 767px) {
  #header .cartNav .header_icon {
    width: min(65px, 16.6666666667vw);
  }
}
#header .cartNav .header_icon.header_icon_my-page {
  background-color: #D5EEF6;
}
#header .cartNav .header_icon.header_icon_cart {
  background-color: #C2E5F1;
}
#header .cartNav .header_icon.header_icon_contact {
  background-color: #ADDEED;
}
#header .cartNav .header_icon a {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  top: 50%;
  left: 50%;
  translate: -50% -50%;
  position: absolute;
  width: 100%;
}
#header .cartNav .header_icon a:hover .header_icon_inner .ic-img.img--01 {
  background-image: url('data:image/svg+xml;utf-8,<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.3022 18.6895C18.1937 19.0068 17.0126 19.1852 15.7817 19.1852C14.5508 19.1852 13.3696 19.0068 12.2613 18.6895C4.21219 19.8273 0 24.9219 0 31.1053H15.7816H31.5634C31.5634 24.9219 27.3519 19.8273 19.3022 18.6895Z" fill="%2357C6EA"/><path d="M15.7815 16.9815C20.5527 16.9815 24.4195 13.6505 24.4195 9.54177V7.43091C24.4195 3.32228 20.5528 -0.00878906 15.7815 -0.00878906C11.0104 -0.00878906 7.14355 3.32228 7.14355 7.43091V9.54177C7.14363 13.6505 11.0104 16.9815 15.7815 16.9815Z" fill="%2357C6EA"/></svg>');
}
#header .cartNav .header_icon a:hover .header_icon_inner .ic-img.img--02 {
  background-image: url('data:image/svg+xml;utf-8,<svg width="35" height="37" viewBox="0 0 35 37" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M33.8703 9.8831C33.2406 9.02429 32.2671 8.48105 31.2042 8.39642L9.21716 6.65567L8.81745 4.392C8.45203 2.32505 6.80675 0.724456 4.72987 0.417357L4.33036 0.357757L1.9534 0.00523592C1.29121 -0.0919579 0.675023 0.364246 0.576806 1.02619C0.478378 1.68871 0.935666 2.30474 1.59785 2.40256V2.402L4.37482 2.81349L4.37545 2.81532C5.41887 2.96795 6.24708 3.77358 6.43088 4.81308L10.1943 26.1352C10.5475 28.1366 12.2862 29.5946 14.3192 29.5952H29.785C30.4546 29.5952 30.9969 29.0526 30.9969 28.3841C30.9969 27.715 30.4546 27.1723 29.785 27.1723H14.3192C13.4631 27.1729 12.7291 26.5569 12.5805 25.7143L12.054 22.7308H29.2944C31.0011 22.7308 32.4818 21.5535 32.865 19.891L34.4856 12.8714C34.7255 11.8337 34.5005 10.743 33.8703 9.8831Z" fill="%2357C6EA"/><path d="M15.2438 30.8936C13.8042 30.8936 12.6377 32.0611 12.6377 33.4996C12.6377 34.938 13.8042 36.1044 15.2438 36.1044C16.6832 36.1044 17.8505 34.938 17.8505 33.4996C17.8504 32.0611 16.6832 30.8936 15.2438 30.8936Z" fill="%2357C6EA"/><path d="M26.8234 30.8936C25.3835 30.8936 24.2173 32.0611 24.2173 33.4996C24.2173 34.938 25.3835 36.1044 26.8234 36.1044C28.2629 36.1044 29.4301 34.938 29.4301 33.4996C29.4301 32.0611 28.2629 30.8936 26.8234 30.8936Z" fill="%2357C6EA"/></svg>');
}
#header .cartNav .header_icon a:hover .header_icon_inner .ic-img.img--03 {
  background-image: url('data:image/svg+xml;utf-8,<svg width="37" height="31" viewBox="0 0 37 31" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.53186 17.9222V5.93848H3.05355C1.37229 5.93848 0 7.34045 0 9.05115V23.6119C0 25.3226 1.37229 26.7247 3.05355 26.7247H7.42816V29.9317C7.42816 30.1462 7.55686 30.3392 7.74984 30.4207C7.94288 30.5021 8.17015 30.4549 8.31593 30.3049L11.8328 26.7247H19.3469C21.0281 26.7247 22.4006 25.3226 22.4006 23.6119V23.6076H12.1545C9.05361 23.6076 6.53186 21.0564 6.53186 17.9222Z" fill="%2357C6EA"/><path d="M32.6487 -0.00976562H12.1546C10.2421 -0.00976562 8.67725 1.58356 8.67725 3.53075V17.922C8.67725 19.8694 10.2421 21.4627 12.1546 21.4627H23.7733L29.0897 26.8255C29.259 26.9977 29.5133 27.0492 29.7342 26.9561C29.9553 26.8628 30.0994 26.6433 30.0994 26.3998V21.4627H32.6488C34.5613 21.4627 36.1261 19.8693 36.1261 17.922V3.53075C36.126 1.58356 34.5612 -0.00976562 32.6487 -0.00976562ZM26.0472 16.9261H13.824V15.2111H26.0472V16.9261ZM30.9794 11.5667H13.824V9.85174H30.9794V11.5667ZM30.9794 6.20718H13.824V4.49218H30.9794V6.20718Z" fill="%2357C6EA"/></svg>');
}
#header .cartNav .header_icon a:hover .header_icon_inner .TX {
  color: #57C6EA;
}
#header .cartNav .header_icon a .header_icon_inner {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  position: relative;
}
@media screen and (min-width: 768px) {
  #header .cartNav .header_icon a .header_icon_inner {
    gap: 10px;
  }
}
@media screen and (max-width: 767px) {
  #header .cartNav .header_icon a .header_icon_inner {
    gap: 5px;
  }
}
#header .cartNav .header_icon a .header_icon_inner .ic-img {
  margin: 0 auto;
  background-position: center;
  background-size: contain;
  background-repeat: no-repeat;
}
@media screen and (min-width: 768px) {
  #header .cartNav .header_icon a .header_icon_inner .ic-img {
    width: 31px;
    height: 31px;
  }
}
@media screen and (max-width: 767px) {
  #header .cartNav .header_icon a .header_icon_inner .ic-img {
    width: min(20px, 5.1282051282vw);
    height: min(20px, 5.1282051282vw);
  }
}
#header .cartNav .header_icon a .header_icon_inner .ic-img.img--01 {
  background-image: url('data:image/svg+xml;utf-8,<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.3022 18.6895C18.1937 19.0068 17.0126 19.1852 15.7817 19.1852C14.5508 19.1852 13.3696 19.0068 12.2613 18.6895C4.21219 19.8273 0 24.9219 0 31.1053H15.7816H31.5634C31.5634 24.9219 27.3519 19.8273 19.3022 18.6895Z" fill="%23F3F9FB"/><path d="M15.7815 16.9815C20.5527 16.9815 24.4195 13.6505 24.4195 9.54177V7.43091C24.4195 3.32228 20.5528 -0.00878906 15.7815 -0.00878906C11.0104 -0.00878906 7.14355 3.32228 7.14355 7.43091V9.54177C7.14363 13.6505 11.0104 16.9815 15.7815 16.9815Z" fill="%23F3F9FB"/></svg>');
}
#header .cartNav .header_icon a .header_icon_inner .ic-img.img--02 {
  background-image: url('data:image/svg+xml;utf-8,<svg width="35" height="37" viewBox="0 0 35 37" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M33.8703 9.8831C33.2406 9.02429 32.2671 8.48105 31.2042 8.39642L9.21716 6.65567L8.81745 4.392C8.45203 2.32505 6.80675 0.724456 4.72987 0.417357L4.33036 0.357757L1.9534 0.00523592C1.29121 -0.0919579 0.675023 0.364246 0.576806 1.02619C0.478378 1.68871 0.935666 2.30474 1.59785 2.40256V2.402L4.37482 2.81349L4.37545 2.81532C5.41887 2.96795 6.24708 3.77358 6.43088 4.81308L10.1943 26.1352C10.5475 28.1366 12.2862 29.5946 14.3192 29.5952H29.785C30.4546 29.5952 30.9969 29.0526 30.9969 28.3841C30.9969 27.715 30.4546 27.1723 29.785 27.1723H14.3192C13.4631 27.1729 12.7291 26.5569 12.5805 25.7143L12.054 22.7308H29.2944C31.0011 22.7308 32.4818 21.5535 32.865 19.891L34.4856 12.8714C34.7255 11.8337 34.5005 10.743 33.8703 9.8831Z" fill="%23F3F9FB"/><path d="M15.2438 30.8936C13.8042 30.8936 12.6377 32.0611 12.6377 33.4996C12.6377 34.938 13.8042 36.1044 15.2438 36.1044C16.6832 36.1044 17.8505 34.938 17.8505 33.4996C17.8504 32.0611 16.6832 30.8936 15.2438 30.8936Z" fill="%23F3F9FB"/><path d="M26.8234 30.8936C25.3835 30.8936 24.2173 32.0611 24.2173 33.4996C24.2173 34.938 25.3835 36.1044 26.8234 36.1044C28.2629 36.1044 29.4301 34.938 29.4301 33.4996C29.4301 32.0611 28.2629 30.8936 26.8234 30.8936Z" fill="%23F3F9FB"/></svg>');
}
#header .cartNav .header_icon a .header_icon_inner .ic-img.img--03 {
  background-image: url('data:image/svg+xml;utf-8,<svg width="37" height="31" viewBox="0 0 37 31" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.53186 17.9222V5.93848H3.05355C1.37229 5.93848 0 7.34045 0 9.05115V23.6119C0 25.3226 1.37229 26.7247 3.05355 26.7247H7.42816V29.9317C7.42816 30.1462 7.55686 30.3392 7.74984 30.4207C7.94288 30.5021 8.17015 30.4549 8.31593 30.3049L11.8328 26.7247H19.3469C21.0281 26.7247 22.4006 25.3226 22.4006 23.6119V23.6076H12.1545C9.05361 23.6076 6.53186 21.0564 6.53186 17.9222Z" fill="%23F3F9FB"/><path d="M32.6487 -0.00976562H12.1546C10.2421 -0.00976562 8.67725 1.58356 8.67725 3.53075V17.922C8.67725 19.8694 10.2421 21.4627 12.1546 21.4627H23.7733L29.0897 26.8255C29.259 26.9977 29.5133 27.0492 29.7342 26.9561C29.9553 26.8628 30.0994 26.6433 30.0994 26.3998V21.4627H32.6488C34.5613 21.4627 36.1261 19.8693 36.1261 17.922V3.53075C36.126 1.58356 34.5612 -0.00976562 32.6487 -0.00976562ZM26.0472 16.9261H13.824V15.2111H26.0472V16.9261ZM30.9794 11.5667H13.824V9.85174H30.9794V11.5667ZM30.9794 6.20718H13.824V4.49218H30.9794V6.20718Z" fill="%23F3F9FB"/></svg>');
}
#header .cartNav .header_icon a .header_icon_inner .cart_badge {
  color: #000;
  text-align: center;
  background-color: #1f3;
  border-radius: 50%;
  z-index: 1;
  display: flex;
  justify-content: center;
  align-items: center;
}
@media screen and (min-width: 768px) {
  #header .cartNav .header_icon a .header_icon_inner .cart_badge {
    font-size: 1.6rem;
    top: -20%;
    right: -60%;
    min-width: 2.4rem;
    height: 2.4rem;
  }
}
@media screen and (max-width: 767px) {
  #header .cartNav .header_icon a .header_icon_inner .cart_badge {
    font-size: 1.2rem;
    top: -20%;
    right: -60%;
    min-width: 1.6rem;
    height: 1.6rem;
  }
}
#header .cartNav .header_icon a .header_icon_inner .TX {
  text-align: center;
  color: #F3F9FB;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: normal;
  white-space: nowrap;
}
@media screen and (min-width: 768px) {
  #header .cartNav .header_icon a .header_icon_inner .TX {
    font-size: 12px;
    letter-spacing: 0.48px;
  }
}
@media screen and (max-width: 767px) {
  #header .cartNav .header_icon a .header_icon_inner .TX {
    font-size: 10px;
    letter-spacing: 0;
  }
}

.gNav {
  background-color: #F3F9FB;
}
@media screen and (min-width: 768px) {
  .gNav {
    padding: 13px 20px;
  }
}
@media screen and (max-width: 767px) {
  .gNav {
    padding: 8px 15px 7px;
  }
}
.gNav .navs {
  margin: 0 auto;
}
@media screen and (min-width: 768px) {
  .gNav .navs {
    max-width: 781px;
  }
}
@media screen and (max-width: 767px) {
  .gNav .navs {
    max-width: 313px;
  }
}
.gNav .navs .links {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.gNav .navs .links .link a {
  color: #585D5F;
  font-weight: 500;
  line-height: normal;
}
@media screen and (min-width: 768px) {
  .gNav .navs .links .link a {
    font-size: 16px;
    letter-spacing: 0.64px;
  }
}
@media screen and (max-width: 767px) {
  .gNav .navs .links .link a {
    font-size: 10px;
    letter-spacing: 0.4px;
  }
}

/* -----------------------
  footer
----------------------- */
#footer {
  background: linear-gradient(180deg, #A8DAE9 0%, #D5EEF6 100%);
  padding: 55px 0 0;
}
@media screen and (max-width: 767px) {
  #footer {
    padding-inline: 20px;
  }
}
#footer .container-sitemap {
  margin: 0 auto;
  display: flex;
}
@media screen and (min-width: 768px) {
  #footer .container-sitemap {
    width: 90%;
    max-width: 880px;
    margin-bottom: 75px;
    gap: 70px;
  }
}
@media screen and (max-width: 767px) {
  #footer .container-sitemap {
    margin-bottom: 60px;
    flex-direction: column;
    gap: 30px;
    position: relative;
  }
}
#footer .container-sitemap .item {
  display: flex;
  flex-direction: column;
  gap: 15px;
  width: fit-content;
}
@media screen and (max-width: 767px) {
  #footer .container-sitemap .item.position {
    position: absolute;
    top: 0;
    left: 180px;
  }
}
#footer .container-sitemap .item .TL {
  color: #FFFFFF;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: normal;
  font-size: 12px;
  text-align: left;
}
#footer .container-sitemap .item ul {
  display: flex;
  flex-direction: column;
  gap: 15px;
}
#footer .container-sitemap .item ul li a {
  color: #FFF;
  color: #FFFFFF;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: normal;
  font-size: 12px;
}
#footer .aside {
  margin-bottom: 30px;
}
@media screen and (max-width: 767px) {
  #footer .aside a {
    width: fit-content;
    display: block;
    margin: 0 auto;
  }
}
#footer .logo {
  font-weight: 600;
  line-height: 1.5;
  width: fit-content;
  margin: 0 auto;
}
@media screen and (min-width: 768px) {
  #footer .logo {
    font-size: 4rem;
  }
}
@media screen and (max-width: 767px) {
  #footer .logo {
    font-size: 2.4rem;
  }
}
#footer .logo a {
  display: block;
}
#footer .logo img {
  width: 100%;
}
@media screen and (min-width: 768px) {
  #footer .logo img {
    max-width: min(300px, 50vw);
  }
}
@media screen and (max-width: 767px) {
  #footer .logo img {
    max-width: min(142px, 36.4102564103vw);
  }
}

@media screen and (min-width: 768px) {
  .footer-after {
    padding: 200px 20px 100px;
  }
}
@media screen and (max-width: 767px) {
  .footer-after {
    padding: 130px 20px;
  }
}
.footer-after-inner {
  display: flex;
  gap: 30px;
}
@media screen and (min-width: 768px) {
  .footer-after-inner {
    justify-content: space-between;
    max-width: 1080px;
    margin: 0 auto;
  }
}
@media screen and (max-width: 767px) {
  .footer-after-inner {
    flex-direction: column;
  }
}
.footer-after-inner .link {
  display: flex;
  justify-content: center;
  align-items: center;
}
@media screen and (min-width: 768px) {
  .footer-after-inner .link {
    width: 500px;
    height: 147px;
  }
}
@media screen and (max-width: 767px) {
  .footer-after-inner .link {
    min-height: 147px;
    padding: 10px;
  }
}
.footer-after-inner .link.green {
  border-top: 1px solid #D3E796;
  border-bottom: 1px solid #D3E796;
  background: #F5FDEA;
}
.footer-after-inner .link.blue {
  border-top: 1px solid #C6E6F0;
  border-bottom: 1px solid #C6E6F0;
  background: #F3F9FB;
}
.footer-after-inner .link-inner {
  display: flex;
  align-items: center;
}
@media screen and (min-width: 768px) {
  .footer-after-inner .link-inner {
    gap: 38px;
  }
}
@media screen and (max-width: 767px) {
  .footer-after-inner .link-inner {
    gap: 22px;
  }
}
.footer-after-inner .link-inner img {
  object-fit: contain;
  object-position: center;
}
.footer-after-inner .link-inner img.icon-beginner {
  width: 59px;
}
.footer-after-inner .link-inner img.icon-contact {
  width: 84px;
}
.footer-after-inner .link-inner .text {
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.footer-after-inner .link-inner .text .TX {
  color: #585D5F;
  font-size: 13px;
  font-weight: 500;
  line-height: normal;
}
.footer-after-inner .link-inner .text .TL {
  color: #585D5F;
  font-family: "yu-mincho-pr6n", sans-serif;
  font-weight: 400;
  font-style: normal;
  font-size: 20px;
  font-weight: 800;
  text-shadow: 0 0 0.5px;
  line-height: 1;
}

/* -----------------------
  C_view_more
----------------------- */
.C_view_more {
  display: block;
  width: fit-content;
  border-radius: 100px;
  border: 1px solid #979EA1;
  padding: 9px 23px;
}
.C_view_more .TX {
  color: #979EA1;
  font-weight: 500;
  font-size: 10px;
  font-family: "yu-gothic-pr6n", sans-serif;
  font-weight: 400;
  font-style: normal;
}
@media screen and (min-width: 768px) {
  .C_view_more .TX {
    line-height: normal;
  }
}
@media screen and (max-width: 767px) {
  .C_view_more .TX {
    line-height: 1.5;
  }
}

/* -----------------------
  application-completed
----------------------- */
/* -----------------------
  application-completed
----------------------- */
.order {
  padding-top: 133px;
}
@media screen and (min-width: 768px) {
  .order .C_TL {
    margin-top: 96px;
  }
}
@media screen and (max-width: 767px) {
  .order .C_TL {
    margin-top: 60px;
  }
}
.order.order-completed .C_TL .TL {
  color: #57C6EA;
}
.order.order-completed .order-completed-TX {
  text-align: center;
  font-size: 16px;
  line-height: 2.1;
  display: flex;
  flex-direction: column;
  color: #989898;
  margin-top: 60px;
  letter-spacing: 1.6px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
}
@media screen and (min-width: 768px) {
  .order.order-completed .order-completed-TX {
    gap: 45px;
  }
}
@media screen and (max-width: 767px) {
  .order.order-completed .order-completed-TX {
    gap: 50px;
  }
}
@media screen and (max-width: 460px) {
  .order.order-completed .order-completed-TX {
    font-size: 14px;
  }
}
.order .C_btn {
  width: auto;
  max-width: 284px;
  height: 62px;
}
@media screen and (min-width: 768px) {
  .order .C_btn {
    margin: 100px auto 0;
  }
}
@media screen and (max-width: 767px) {
  .order .C_btn {
    margin: 60px auto 0;
  }
}
@media screen and (max-width: 460px) {
  .order .C_btn {
    height: 55px;
  }
  .order .C_btn .TX {
    font-size: 18px;
  }
}

/* -----------------------
  buying-guide
----------------------- */
.buying-guide {
  color: #585D5F;
}
.buying-guide-link {
  display: flex;
  flex-wrap: wrap;
  gap: 10px 0;
  justify-content: center;
}
@media screen and (min-width: 768px) {
  .buying-guide-link {
    margin: 90px auto 0;
  }
}
@media screen and (max-width: 767px) {
  .buying-guide-link {
    margin: 60px auto 0;
    width: 350px;
  }
}
@media screen and (max-width: 460px) {
  .buying-guide-link {
    width: 100%;
  }
}
.buying-guide-link .link {
  text-align: center;
  border-right: 1px solid #ADDEED;
}
@media screen and (min-width: 768px) {
  .buying-guide-link .link {
    width: 20%;
  }
}
@media screen and (max-width: 767px) {
  .buying-guide-link .link {
    width: 50%;
  }
}
.buying-guide-link .link a {
  display: block;
  width: 100%;
  height: 100%;
  padding: 16px 0 46px;
}
.buying-guide-link .link .TX {
  color: #585D5F;
  font-size: 12px;
  position: relative;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
}
.buying-guide-link .link .TX::before {
  content: "";
  border-radius: 50%;
  background: #57C6EA;
  position: absolute;
  left: 50%;
  translate: -50% 0;
  width: 16px;
  height: 16px;
  top: 28px;
}
.buying-guide-link .link .TX::after {
  content: "";
  border-right: 2px solid #FFFFFF;
  border-bottom: 2px solid #FFFFFF;
  border-radius: 1px;
  position: absolute;
  width: 6px;
  height: 7px;
  top: 31px;
  left: 50%;
  translate: -50% 0;
  rotate: 45deg;
}
@media screen and (min-width: 768px) {
  .buying-guide-link .link:nth-child(5n) {
    border-right: none;
  }
}
@media screen and (max-width: 767px) {
  .buying-guide-link .link:nth-child(2n) {
    border-right: none;
  }
}
.buying-guide #howto-order {
  margin: 100px auto 0;
}
@media screen and (max-width: 767px) {
  .buying-guide #howto-order {
    width: 90%;
  }
}
@media screen and (min-width: 768px) {
  .buying-guide #howto-order .howto-order-list {
    margin-top: 73px;
  }
}
@media screen and (max-width: 767px) {
  .buying-guide #howto-order .howto-order-list {
    margin-top: 58px;
  }
}
.buying-guide #howto-order .howto-order-list li {
  margin-top: 60px;
  display: flex;
}
@media screen and (max-width: 767px) {
  .buying-guide #howto-order .howto-order-list li {
    flex-direction: column;
  }
}
.buying-guide #howto-order .howto-order-list li .img {
  background-color: rgb(203, 199, 199);
  border-radius: 10px;
}
@media screen and (min-width: 768px) {
  .buying-guide #howto-order .howto-order-list li .img {
    width: 49%;
    aspect-ratio: 5/3;
    margin-right: 50px;
  }
}
@media screen and (max-width: 767px) {
  .buying-guide #howto-order .howto-order-list li .img {
    width: 100%;
    margin-top: 25px;
    aspect-ratio: 5/3;
    order: 2;
  }
}
.buying-guide #howto-order .howto-order-list li .textbox {
  font-size: 16px;
  letter-spacing: 1.6px;
}
@media screen and (min-width: 768px) {
  .buying-guide #howto-order .howto-order-list li .textbox {
    flex: 1;
  }
}
@media screen and (max-width: 767px) {
  .buying-guide #howto-order .howto-order-list li .textbox {
    display: contents;
  }
}
.buying-guide #howto-order .howto-order-list li .textbox .label {
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  font-size: 16px;
  letter-spacing: 1.6px;
}
@media screen and (min-width: 768px) {
  .buying-guide #howto-order .howto-order-list li .textbox .label {
    top: 0;
    left: 55%;
    width: 100%;
  }
}
@media screen and (max-width: 767px) {
  .buying-guide #howto-order .howto-order-list li .textbox .label {
    order: 1;
  }
}
.buying-guide #howto-order .howto-order-list li .textbox .TX {
  margin-top: 20px;
  line-height: 1.8;
}
@media screen and (min-width: 768px) {
  .buying-guide #howto-order .howto-order-list li .textbox .TX {
    flex: 1;
    margin-top: 25px;
  }
}
@media screen and (max-width: 767px) {
  .buying-guide #howto-order .howto-order-list li .textbox .TX {
    order: 3;
  }
}
.buying-guide #howto-order .howto-order-list:first-child {
  margin-top: none;
}
.buying-guide #howto-login {
  margin: 0 auto;
}
@media screen and (min-width: 768px) {
  .buying-guide #howto-login {
    margin-top: 200px;
  }
}
@media screen and (max-width: 767px) {
  .buying-guide #howto-login {
    margin-top: 130px;
    width: 90%;
  }
}
.buying-guide #howto-login .TX {
  margin-top: 70px;
  font-size: 16px;
  letter-spacing: 1.6px;
  line-height: 1.8;
}

/* -----------------------
  law
----------------------- */
.law {
  color: #585D5F;
  line-height: 1.6;
}
.law .law-list {
  display: flex;
  flex-direction: column;
}
@media screen and (min-width: 768px) {
  .law .law-list {
    max-width: 746px;
    margin: 100px auto 0;
    gap: 57px;
  }
}
@media screen and (max-width: 767px) {
  .law .law-list {
    width: 90%;
    margin: 114px auto 0;
    gap: 53px;
  }
}
.law .law-list li .label {
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  font-size: 20px;
  letter-spacing: 2px;
}
.law .law-list li .sublabel {
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  font-style: 15px;
  margin-top: 25px;
}
@media screen and (min-width: 768px) {
  .law .law-list li .sublabel {
    margin-left: 25px;
  }
}
@media screen and (max-width: 767px) {
  .law .law-list li .sublabel {
    margin-left: 15px;
  }
}
.law .law-list li .TX {
  font-size: 15px;
  letter-spacing: 1.5px;
  margin-top: 3px;
}
@media screen and (min-width: 768px) {
  .law .law-list li .TX {
    margin-left: 25px;
  }
}
@media screen and (max-width: 767px) {
  .law .law-list li .TX {
    margin-left: 15px;
  }
}
.law .law-list li .TX a {
  color: #585D5F;
  border-bottom: 1px solid;
}

/* -----------------------
  privacy-policy
----------------------- */
.privacy-policy {
  color: #585D5F;
  line-height: 1.6;
  letter-spacing: 1.6px;
}
@media screen and (max-width: 767px) {
  .privacy-policy {
    width: 90%;
    margin: 0 auto;
  }
}
.privacy-policy .top-TX {
  font-size: 16px;
  letter-spacing: 1.8px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
}
@media screen and (min-width: 768px) {
  .privacy-policy .top-TX {
    margin-top: 100px;
  }
}
@media screen and (max-width: 767px) {
  .privacy-policy .top-TX {
    margin-top: 60px;
  }
}
.privacy-policy .content {
  margin-top: 70px;
}
.privacy-policy .content-TL {
  font-size: 20px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
}
.privacy-policy .content-TX {
  font-size: 15px;
}
@media screen and (max-width: 767px) {
  .privacy-policy .content .table-wrap {
    width: 100%;
    overflow-x: auto;
  }
}
.privacy-policy .content .table-wrap .table {
  margin-top: 30px;
  color: #585D5F;
  font-weight: 400;
}
@media screen and (min-width: 768px) {
  .privacy-policy .content .table-wrap .table {
    width: 100%;
  }
}
@media screen and (max-width: 767px) {
  .privacy-policy .content .table-wrap .table {
    width: 880px;
  }
}
.privacy-policy .content .table-wrap .table .top {
  color: #FFFFFF;
  font-size: 15px;
  padding: 8px 0;
  text-align: center;
}
.privacy-policy .content .table-wrap .table .top th {
  background: #A8DAE9;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
}
.privacy-policy .content .table-wrap .table th,
.privacy-policy .content .table-wrap .table td {
  border: none;
  margin-top: 1px;
}
.privacy-policy .content .table-wrap .table .item {
  font-size: 10px;
}
.privacy-policy .content .table-wrap .table .item .label {
  background: #DDF0F8;
  padding: 11px 0 11px 3%;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
}
.privacy-policy .content .table-wrap .table .item .TX {
  background: #F3F9FB;
  padding: 11px 0 11px 3%;
}
.privacy-policy .content .table-wrap .table .item .TX .point {
  color: #585D5F;
  margin-bottom: 4px;
  font-weight: 400;
}
.privacy-policy .content .table-wrap .table .item .TX .point::before {
  content: "";
  width: 6px;
  height: 6px;
  background: #585D5F;
  border-radius: 50%;
  display: inline-block;
  margin-right: 12px;
}
.privacy-policy .content .table-wrap .table .label {
  width: 32.0454545455%;
}
.privacy-policy .content-subTL {
  font-size: 18px;
  margin-top: 60px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
}
.privacy-policy .content .listbox {
  margin: 30px 0 0 50px;
  counter-reset: circle;
}
.privacy-policy .content .listbox .list {
  position: relative;
}
.privacy-policy .content .listbox .list::before {
  counter-increment: circle;
  content: counter(circle) ".";
  position: absolute;
  top: 0;
  left: -35px;
  font-size: 15px;
}

/* -----------------------
  my-history
----------------------- */
.my {
  color: #585D5F;
}
@media screen and (max-width: 767px) {
  .my {
    width: 90%;
    margin: 0 auto;
  }
}
.my h3 {
  color: #989898;
  font-size: 16px;
  letter-spacing: 1.6px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
}
.my .h3-under {
  margin-top: 8px;
}
@media screen and (min-width: 768px) {
  .my .my-wrap {
    margin-top: 100px;
  }
}
@media screen and (max-width: 767px) {
  .my .my-wrap {
    margin-top: 120px;
  }
}

.my-history .myPageHistory .history {
  color: #989898;
  font-size: 16px;
  letter-spacing: 1.6px;
  margin-top: 8px;
}
.my-history .myPageHistory .history .number {
  color: #57C6EA;
  letter-spacing: 2.4px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  margin-left: 20px;
}
.my-history .myPageHistory .historyBox {
  margin-top: 26px;
  border: none;
}
.my-history .myPageHistory .historyBox .item {
  display: flex;
}
@media screen and (max-width: 767px) {
  .my-history .myPageHistory .historyBox .item {
    flex-wrap: wrap;
  }
}
.my-history .myPageHistory .historyBox .item .historyDetailCol {
  width: 100%;
}
@media screen and (max-width: 767px) {
  .my-history .myPageHistory .historyBox .item .historyDetailCol {
    width: 50%;
  }
}
.my-history .myPageHistory .historyBox .item .historyDetailCol dt {
  background: #F2F2F2;
  padding: 13px 18px;
}
.my-history .myPageHistory .historyBox .item .historyDetailCol dd {
  padding: 13px 18px;
  border: none;
}
@media screen and (min-width: 768px) {
  .my-history .myPageHistory .historyBox .item .historyDetailCol.Detail-1 {
    width: 22.0454545455%;
  }
  .my-history .myPageHistory .historyBox .item .historyDetailCol.Detail-2 {
    width: 24.8863636364%;
  }
  .my-history .myPageHistory .historyBox .item .historyDetailCol.Detail-3 {
    width: 15.2272727273%;
  }
  .my-history .myPageHistory .historyBox .item .historyDetailCol.Detail-4 {
    width: 37.7272727273%;
  }
}
.my-history .myPageHistory .historyBox .item .history-content {
  display: flex;
  padding: 23px 0 23px 31px;
}
.my-history .myPageHistory .historyBox .item .history-content .img {
  aspect-ratio: 1/1;
}
@media screen and (min-width: 768px) {
  .my-history .myPageHistory .historyBox .item .history-content .img {
    width: 130px;
  }
}
@media screen and (max-width: 767px) {
  .my-history .myPageHistory .historyBox .item .history-content .img {
    width: 103px;
  }
}
.my-history .myPageHistory .historyBox .item .history-content-TX {
  font-size: 16px;
  line-height: 2;
  margin: 11px 0 0 28px;
}
.my-history .myPageHistory .historyBox .C_line {
  margin-top: 0;
}

/* -----------------------
  my-info-change
----------------------- */
.my-info-change .top-TX {
  color: #989898;
  font-size: 12px;
  letter-spacing: 1.2px;
  line-height: 1.5;
}
@media screen and (min-width: 768px) {
  .my-info-change .top-TX {
    margin-top: 10px;
  }
}
@media screen and (max-width: 767px) {
  .my-info-change .top-TX {
    margin-top: 17px;
  }
}
@media screen and (min-width: 768px) {
  .my-info-change .change-wrap {
    width: 78.6363636364%;
    margin: 0 auto;
  }
}
@media screen and (min-width: 768px) {
  .my-info-change .change-wrap .change-content {
    margin-top: 11px;
  }
}
@media screen and (max-width: 767px) {
  .my-info-change .change-wrap .change-content {
    margin-top: 20px;
  }
}
.my-info-change .change-wrap .change-content .form {
  display: flex;
  flex-direction: column;
  gap: 1px;
}
.my-info-change .change-wrap .change-content .form .item {
  display: flex;
}
.my-info-change .change-wrap .change-content .form .item .label {
  background: #A8DAE9;
  color: #FFFFFF;
  font-size: 15px;
  padding: 18px 0;
  display: grid;
  place-content: center center;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
}
@media screen and (min-width: 768px) {
  .my-info-change .change-wrap .change-content .form .item .label {
    min-width: 147px;
  }
}
@media screen and (max-width: 767px) {
  .my-info-change .change-wrap .change-content .form .item .label {
    width: 34.8571428571%;
  }
}
.my-info-change .change-wrap .change-content .form .item .content {
  background: #F3F9FB;
  width: 100%;
  display: flex;
  align-items: center;
  margin-left: 1px;
}
@media screen and (min-width: 768px) {
  .my-info-change .change-wrap .change-content .form .item .content {
    padding-left: 38px;
  }
}
@media screen and (max-width: 767px) {
  .my-info-change .change-wrap .change-content .form .item .content {
    padding-inline: 15px 6px;
    width: 64.5714285714%;
    flex: 1;
  }
}
.my-info-change .change-wrap .change-content .form .item .content .name-item {
  display: flex;
  align-items: center;
}
.my-info-change .change-wrap .change-content .form .item .content .btn {
  background: #A8DAE9;
  color: #FFFFFF;
  font-size: 10px;
  padding: 4px 12px;
  border-radius: 5px;
  width: fit-content;
  display: flex;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
}
@media screen and (min-width: 768px) {
  .my-info-change .change-wrap .change-content .form .item .content .btn {
    margin-left: 22px;
  }
}
@media screen and (max-width: 767px) {
  .my-info-change .change-wrap .change-content .form .item .content .btn {
    margin-left: auto;
  }
}
.my-info-change .change-wrap .change-content .form .item .content ul {
  width: 100%;
}
.my-info-change .change-wrap .change-content .form .item .content ul li {
  width: 100%;
}
.my-info-change .change-wrap .change-content .form .item .content ul li .form-check-input {
  display: none;
}
.my-info-change .change-wrap .change-content .form .item .content .radioArea {
  display: flex;
}
@media screen and (min-width: 768px) {
  .my-info-change .change-wrap .change-content .form .item .content .radioArea {
    gap: 40px;
  }
}
.my-info-change .change-wrap .change-content .form .item .content .radioArea .form-check {
  display: flex;
  align-items: center;
}
@media screen and (max-width: 767px) {
  .my-info-change .change-wrap .change-content .form .item .content .radioArea .form-check {
    padding-left: 0;
  }
}
.my-info-change .change-wrap .change-content .form .item .content .radioArea input[type=radio] {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
}
.my-info-change .change-wrap .change-content .form .item .content .radioArea input[type=radio] {
  position: relative;
  width: 24px;
  height: 24px;
  background: #FFFFFF;
  border-radius: 50%;
  vertical-align: -2px;
  margin: 0 12px 0 0;
}
.my-info-change .change-wrap .change-content .form .item .content .radioArea input[type=radio]:checked:before {
  position: absolute;
  top: 50%;
  left: 50%;
  translate: -50% -50%;
  width: 14px;
  height: 14px;
  border-radius: 50%;
  background: #A8DAE9;
  content: "";
}
.my-info-change .change-wrap .change-content .form .item .content.birthday {
  display: flex;
}
@media screen and (min-width: 768px) {
  .my-info-change .change-wrap .change-content .form .item .content.birthday {
    gap: 24px;
  }
}
@media screen and (max-width: 767px) {
  .my-info-change .change-wrap .change-content .form .item .content.birthday {
    width: 100%;
    flex: 1;
  }
}
.my-info-change .change-wrap .change-content .form .item .content.birthday .number {
  display: flex;
  align-items: center;
  gap: 5px;
  color: #585D5F;
}
.my-info-change .change-wrap .change-content .form .item .content.birthday .number .custom-select {
  border: none;
  height: 35px;
}
@media screen and (min-width: 768px) {
  .my-info-change .change-wrap .change-content .form .item .content.birthday .number.birthday_y {
    width: 24.0808823529%;
  }
}
@media screen and (max-width: 767px) {
  .my-info-change .change-wrap .change-content .form .item .content.birthday .number.birthday_y {
    width: 39.8230088496%;
  }
}
@media screen and (min-width: 768px) {
  .my-info-change .change-wrap .change-content .form .item .content.birthday .number.birthday_y .custom-select {
    width: 87.786259542%;
  }
}
@media screen and (max-width: 767px) {
  .my-info-change .change-wrap .change-content .form .item .content.birthday .number.birthday_y .custom-select {
    width: 75.5813953488%;
  }
}
@media screen and (min-width: 768px) {
  .my-info-change .change-wrap .change-content .form .item .content.birthday .number.birthday_m, .my-info-change .change-wrap .change-content .form .item .content.birthday .number.birthday_d {
    width: 15.8088235294%;
  }
}
@media screen and (max-width: 767px) {
  .my-info-change .change-wrap .change-content .form .item .content.birthday .number.birthday_m, .my-info-change .change-wrap .change-content .form .item .content.birthday .number.birthday_d {
    width: 30.9734513274%;
  }
}
@media screen and (min-width: 768px) {
  .my-info-change .change-wrap .change-content .form .item .content.birthday .number.birthday_m .custom-select, .my-info-change .change-wrap .change-content .form .item .content.birthday .number.birthday_d .custom-select {
    width: 81.3953488372%;
  }
}
@media screen and (max-width: 767px) {
  .my-info-change .change-wrap .change-content .form .item .content.birthday .number.birthday_m .custom-select, .my-info-change .change-wrap .change-content .form .item .content.birthday .number.birthday_d .custom-select {
    width: 67.7966101695%;
  }
}
.my-info-change .change-wrap .change-content .form.second {
  display: flex;
}
.my-info-change .change-wrap .change-content .form.second .label-none {
  background-color: #F3F9FB;
}
@media screen and (max-width: 767px) {
  .my-info-change .change-wrap .change-content .form.second .item {
    flex-direction: column;
  }
}
@media screen and (max-width: 767px) {
  .my-info-change .change-wrap .change-content .form.second .item .label {
    width: 100%;
    display: block;
    padding-left: 21px;
  }
}
@media screen and (max-width: 767px) {
  .my-info-change .change-wrap .change-content .form.second .item .content {
    width: 100%;
    padding-block: 14px;
  }
}
.my-info-change .change-wrap .change-content .form.second .item .content .blue {
  align-items: center;
  display: flex;
}
@media screen and (min-width: 768px) {
  .my-info-change .change-wrap .change-content .form.second .item .content .blue {
    margin-left: 8px;
  }
}
.my-info-change .change-wrap .change-content .form.second .item .content .blue .mail {
  font-size: 15px;
  color: #585D5F;
}
.my-info-change .change-wrap .change-content .form.second .item .content .btn {
  background: #FFFFFF;
  border: 1px solid #A8DAE9;
  color: #A8DAE9;
  padding: 5px 23px 5px 13px;
}
.my-info-change .change-wrap .change-content .form.second .item .content .btn::after {
  right: 1.2em;
  rotate: 90deg;
}
.my-info-change .change-wrap .change-content .form.second .item .content [type=checkbox]:checked + label::after {
  rotate: 180deg !important;
}
.my-info-change .change-wrap .change-content .form.second .item .content.edit {
  color: #989898;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: center;
}
@media screen and (min-width: 768px) {
  .my-info-change .change-wrap .change-content .form.second .item .content.edit {
    gap: 15px;
  }
}
.my-info-change .change-wrap .change-content .form.second .item .content.edit #passwd {
  width: 100%;
}
.my-info-change .change-wrap .change-content .form.second .item .content.edit .pass-btn {
  display: flex;
  align-items: flex-start;
}
@media screen and (max-width: 767px) {
  .my-info-change .change-wrap .change-content .form.second .item .content.edit .pass-btn {
    margin-left: 14px;
  }
}
.my-info-change .change-wrap .change-content .form.second .item .content.edit .description {
  font-size: 10px;
  line-height: 1.5;
  letter-spacing: 0.5px;
  width: 87.1541501976%;
}
.my-info-change .change-wrap .change-content .form.second .item .content.edit .ime_d {
  border: none;
  height: 35px;
}
@media screen and (min-width: 768px) {
  .my-info-change .change-wrap .change-content .form.second .item .content.edit .ime_d {
    width: 89.7233201581%;
    margin: 5px 0 15px;
  }
}
@media screen and (max-width: 767px) {
  .my-info-change .change-wrap .change-content .form.second .item .content.edit .ime_d {
    width: 88.1818181818%;
    margin: 3px 0 15px;
  }
}
.my-info-change .change-wrap .change-content .form.second .item .content.edit.pull-item {
  padding-block: 18px;
}
@media screen and (min-width: 768px) {
  .my-info-change .change-wrap .change-content .form.pass-form {
    margin-top: 30px;
  }
}
@media screen and (max-width: 767px) {
  .my-info-change .change-wrap .change-content .form.pass-form {
    margin-top: 60px;
  }
}
.my-info-change .change-wrap .change-content .caption {
  border: none;
}
.my-info-change .change-wrap .change-content .btnArea {
  width: fit-content;
}
@media screen and (min-width: 768px) {
  .my-info-change .change-wrap .change-content .btnArea {
    margin: 60px auto 150px;
  }
}
@media screen and (max-width: 767px) {
  .my-info-change .change-wrap .change-content .btnArea {
    margin: 60px auto 100px;
  }
}
.my-info-change .change-wrap .change-content .btnArea .btn-wrap .btn-check {
  background: #57C6EA;
  color: #FFFFFF;
  font-size: 15px;
  letter-spacing: 1.5px;
  text-align: center;
  border: none;
  border-radius: 5px;
  display: block;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
}
@media screen and (min-width: 768px) {
  .my-info-change .change-wrap .change-content .btnArea .btn-wrap .btn-check {
    width: 427px;
    padding: 16px;
  }
}
@media screen and (max-width: 767px) {
  .my-info-change .change-wrap .change-content .btnArea .btn-wrap .btn-check {
    width: 183px;
    padding: 18px 0;
  }
}
.my-info-change .change-wrap .change-content .btnArea .btn-wrap::after {
  display: none;
}
.my-info-change .change-wrap #regular_list_detail {
  background: #F3F9FB;
  font-size: 13px;
}
@media screen and (min-width: 768px) {
  .my-info-change .change-wrap #regular_list_detail {
    margin-top: 36px;
    padding: 47px 40px 50px;
  }
}
@media screen and (max-width: 767px) {
  .my-info-change .change-wrap #regular_list_detail {
    margin-top: 47px;
    padding: 47px 20px 50px;
  }
}
.my-info-change .change-wrap #regular_list_detail #creditForm tbody {
  display: flex;
  flex-direction: column;
  gap: 30px;
}
.my-info-change .change-wrap #regular_list_detail #creditForm tbody tr {
  display: flex;
}
.my-info-change .change-wrap #regular_list_detail #creditForm tbody tr td {
  flex: 1;
}
.my-info-change .change-wrap #regular_list_detail #creditForm tbody tr td .efoBox input, .my-info-change .change-wrap #regular_list_detail #creditForm tbody tr td .efoBox select {
  height: 46px;
  margin-top: 4px;
  background: #FFFFFF;
  border: none;
}
.my-info-change .change-wrap #regular_list_detail #creditForm tbody tr td .align-items-baseline {
  align-items: center !important;
}
.my-info-change .change-wrap #regular_list_detail #creditForm tbody tr td .m-small {
  font-size: 0 !important;
  position: relative;
  top: 33px;
}
.my-info-change .change-wrap #regular_list_detail #creditForm tbody tr td .m-small a {
  display: block;
  width: 100%;
  height: 20px;
  position: absolute;
  top: 0;
}
.my-info-change .change-wrap #regular_list_detail #creditForm tbody tr td .m-small::before {
  content: "セキュリティコードとは";
  color: #989898;
  font-size: 13px;
}
.my-info-change .change-wrap #regular_list_detail #creditForm tbody tr td .m-small::after {
  content: "?";
  font-size: 13px;
  width: 23px;
  height: 23px;
  border: 1px solid #989898;
  border-radius: 50%;
  display: grid;
  place-items: center center;
  position: absolute;
  top: 50%;
  translate: 0 -50%;
  left: -28px;
}
.my-info-change .change-wrap #regular_list_detail #creditForm .btn {
  background: #EED06E;
  color: #FFFFFF;
  height: 46px;
  margin-top: 35px;
}
.my-info-change .change-wrap #regular_list_detail .credit tbody tr td .custom-select {
  border: none;
  height: 46px;
  margin-top: 4px;
}
@media screen and (min-width: 768px) {
  .my-info-change .change-wrap .new-card {
    margin-top: 100px;
  }
}
@media screen and (max-width: 767px) {
  .my-info-change .change-wrap .new-card {
    margin-top: 60px;
  }
}

/* -----------------------
  my-info-change-check
----------------------- */
@media screen and (min-width: 768px) {
  .my-info-change-check .change-content {
    margin-top: 30px !important;
  }
}
@media screen and (max-width: 767px) {
  .my-info-change-check .change-content {
    margin-top: 35px !important;
  }
}
@media screen and (min-width: 768px) {
  .my-info-change-check .caption {
    margin-top: 35px;
  }
}
@media screen and (max-width: 767px) {
  .my-info-change-check .caption {
    margin-top: 32px;
  }
}
.my-info-change-check .second .item .content {
  width: 100% !important;
  padding-block: 18px !important;
}
.my-info-change-check .second.top-second {
  margin-top: 15px;
}
.my-info-change-check .btn-box {
  display: flex;
  flex-direction: row-reverse;
  justify-content: center;
  width: auto !important;
}
@media screen and (min-width: 768px) {
  .my-info-change-check .btn-box {
    margin: 100px auto 30px !important;
    gap: 23px;
  }
}
@media screen and (max-width: 767px) {
  .my-info-change-check .btn-box {
    width: 90%;
    margin: 60px auto 20px !important;
    gap: 15px;
  }
}
@media screen and (min-width: 768px) {
  .my-info-change-check .btn-box .C_btn_wrap {
    height: 70px;
  }
}
@media screen and (max-width: 767px) {
  .my-info-change-check .btn-box .C_btn_wrap {
    height: 50px;
  }
}
@media screen and (min-width: 768px) {
  .my-info-change-check .btn-box .C_btn_wrap.wrap-1 {
    width: 61.7052023121%;
  }
}
@media screen and (max-width: 767px) {
  .my-info-change-check .btn-box .C_btn_wrap.wrap-1 {
    width: 43.4285714286%;
    min-width: 200px;
  }
}
@media screen and (max-width: 460px) {
  .my-info-change-check .btn-box .C_btn_wrap.wrap-1 {
    min-width: 170px;
  }
}
@media screen and (max-width: 460px) {
  .my-info-change-check .btn-box .C_btn_wrap.wrap-1 .btn-wrap .TX {
    font-size: 16px;
  }
}
.my-info-change-check .btn-box .C_btn_wrap.wrap-1 .btn-wrap::after {
  display: none;
}
@media screen and (min-width: 768px) {
  .my-info-change-check .btn-box .C_btn_wrap.wrap-2 {
    width: 34.9710982659%;
  }
}
@media screen and (max-width: 767px) {
  .my-info-change-check .btn-box .C_btn_wrap.wrap-2 {
    width: 43.4285714286%;
  }
}
.my-info-change-check .btn-box .C_btn_wrap.wrap-2 .btn-wrap .TX::after {
  border-top: 1px solid #FFFFFF;
  border-right: 1px solid #FFFFFF;
  left: 26.8595041322%;
}
.my-info-change-check .btn-box .C_btn {
  width: 100%;
  border: none;
}
@media screen and (max-width: 767px) {
  .my-info-change-check .btn-box .C_btn {
    height: 58px;
  }
}
.my-info-change-check .btn-box .C_btn input {
  background: none;
  border: none;
  outline: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  color: #FFFFFF;
}

/* -----------------------
  my-change-comp
----------------------- */
.my-change-comp .top-TX {
  font-size: 16px;
  color: #989898;
  line-height: 1.8;
  letter-spacing: 1.6px;
}
@media screen and (min-width: 768px) {
  .my-change-comp .top-TX {
    margin-top: 10px;
  }
}
@media screen and (max-width: 767px) {
  .my-change-comp .top-TX {
    margin-top: 20px;
  }
}
.my-change-comp .C_btn {
  width: 284px;
  height: 62px;
  margin: 60px auto 0;
}

/* -----------------------
  my-contact
----------------------- */
.my-contact .under-TX {
  color: #989898;
  margin-top: 10px;
}
@media screen and (min-width: 768px) {
  .my-contact .pagerArea {
    margin: 46px 0 5px;
  }
}
@media screen and (max-width: 767px) {
  .my-contact .pagerArea {
    margin: 30px 0 11px;
  }
}
.my-contact .pagerArea .form-inline {
  font-size: 10px;
  color: #989898;
}
.my-contact .pagerArea .form-inline .custom-select {
  font-size: 10px;
  border-radius: 5px;
  color: #989898;
}
@media screen and (max-width: 767px) {
  .my-contact .myInfoHistoryBox li {
    flex-direction: column;
  }
}
.my-contact .myInfoHistoryBox li .historyDetailCol {
  width: 100%;
}
@media screen and (min-width: 768px) {
  .my-contact .myInfoHistoryBox li .historyDetailCol {
    flex-basis: 33.3333333333% !important;
  }
}
.my-contact .myInfoHistoryBox li .historyDetailCol dt {
  color: #989898;
  font-size: 16px;
  padding: 13px 0 13px 18px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
}
.my-contact .myInfoHistoryBox li .historyDetailCol dd {
  font-size: 16px;
  padding: 13px 0 13px 18px;
}
.my-contact .myInfoHistoryBox li .historyDetailCol dd a {
  color: #585D5F;
}

/* -----------------------
  my-regular
----------------------- */
.my-regular .under-TX,
.my-regular .noData {
  font-size: 16px;
  color: #989898;
  letter-spacing: 1.6px;
}
.my-regular .under-TX {
  margin-top: 10px;
}
.my-regular .noData {
  margin-top: 25px;
}
.my-regular .subscHistoryBox {
  margin-top: 25px;
  border: none;
}
@media screen and (min-width: 768px) {
  .my-regular .subscHistoryBox .historyDetailCol {
    flex-basis: 33.3333333333% !important;
  }
}

/* -----------------------
  my-adress
----------------------- */
.my-adress .top-TX {
  font-size: 16px;
  letter-spacing: 1.6px;
  line-height: 1.8;
  color: #989898;
}
.my-adress .top-TX.top {
  margin-top: 12px;
}
.my-adress .top-TX.second {
  margin-top: 35px;
}
.my-adress .top-TX.second a {
  color: #57C6EA;
}
.my-adress .mainForm {
  margin-top: 30px;
}
.my-adress .mainForm .delivAddressBox {
  font-size: 16px;
  border: none;
}
.my-adress .mainForm .delivAddressBox .delivAddCol {
  border: none;
  color: #989898;
}
.my-adress .mainForm .delivAddressBox .delivAddCol dt {
  border: none;
  padding: 13px 0 13px 18px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
}
.my-adress .mainForm .delivAddressBox .delivAddCol dd {
  line-height: 1.5;
}
@media screen and (max-width: 767px) {
  .my-adress .mainForm .delivAddressBox .delivAddCol dd .btn-box {
    justify-content: center;
  }
}
.my-adress .mainForm .delivAddressBox .delivAddCol dd .btn-box .btn-1 {
  padding-inline: 0;
}
.my-adress .mainForm .delivAddressBox .delivAddCol dd .btn-box .btn-1 .btn {
  background: #A8DAE9;
}
@media screen and (max-width: 767px) {
  .my-adress .mainForm .delivAddressBox .delivAddCol dd .btn-box .btn-1 .btn {
    margin-left: 25px;
  }
}
.my-adress .mainForm .delivAddressBox .delivAddCol dd .btn-box .btn-2 {
  padding-inline: 0;
}
.my-adress .mainForm .delivAddressBox .delivAddCol dd .btn-box .btn-2 .btn {
  background: #D1D1D1;
}
@media screen and (min-width: 768px) {
  .my-adress .mainForm .delivAddressBox .delivAddCol dd .btn-box .btn-2 .btn {
    margin-right: 55px;
  }
}
@media screen and (max-width: 767px) {
  .my-adress .mainForm .delivAddressBox .delivAddCol dd .btn-box .btn-2 .btn {
    margin-right: 25px;
  }
}
.my-adress .mainForm .delivAddressBox .delivAddCol dd .btn-box .btn {
  color: #FFFFFF;
  border-radius: 5px;
}
@media screen and (min-width: 768px) {
  .my-adress .mainForm .delivAddressBox .delivAddCol dd .btn-box .btn {
    width: 68px;
    height: 30px;
    line-height: 2;
  }
}
@media screen and (max-width: 767px) {
  .my-adress .mainForm .delivAddressBox .delivAddCol dd .btn-box .btn {
    width: 66.049382716%;
    height: 37px;
    line-height: 2.5;
  }
}
.my-adress .mainForm .C_btn {
  height: 52px;
}
@media screen and (min-width: 768px) {
  .my-adress .mainForm .C_btn {
    width: 284px;
    margin: 60px 0 0 auto;
  }
}
@media screen and (max-width: 767px) {
  .my-adress .mainForm .C_btn {
    width: 81.1428571429%;
    margin: 71px auto 0;
  }
}
.my-adress .mainForm .C_btn .TX {
  font-size: 16px !important;
  position: relative;
}
@media screen and (max-width: 385px) {
  .my-adress .mainForm .C_btn .TX {
    font-size: 13px !important;
  }
}
.my-adress .mainForm .C_btn .TX::before {
  content: "";
  position: absolute;
  width: 9px;
  height: 9px;
  border-top: 1px solid #FFFFFF;
  border-right: 1px solid #FFFFFF;
  rotate: 45deg;
  top: 50%;
  translate: 0 -50%;
}
@media screen and (min-width: 768px) {
  .my-adress .mainForm .C_btn .TX::before {
    right: -20px;
  }
}
@media screen and (max-width: 767px) {
  .my-adress .mainForm .C_btn .TX::before {
    right: -15px;
  }
}

/* -----------------------
  my-newaddress
----------------------- */
@media screen and (max-width: 767px) {
  .my-newaddress {
    width: 100%;
  }
}
@media screen and (max-width: 767px) {
  .my-newaddress .size {
    width: 90%;
    margin-inline: auto;
  }
}
.my-newaddress .top-TX {
  font-size: 16px;
  letter-spacing: 1.6px;
  line-height: 1.8;
  color: #989898;
  margin-top: 10px;
}
.my-newaddress form {
  background: #F3F9FB;
  display: flex;
  flex-direction: column;
  gap: 30px;
}
@media screen and (min-width: 768px) {
  .my-newaddress form {
    margin-top: 30px;
    padding: 53px 12.6477541371% 76px;
  }
}
@media screen and (max-width: 767px) {
  .my-newaddress form {
    margin-top: 34px;
    padding: 36px 8.9743589744% 76px;
  }
}
@media screen and (max-width: 767px) {
  .my-newaddress form {
    margin-top: 34px;
  }
}
.my-newaddress form .item .label {
  font-size: 13px;
  color: #989898;
}
.my-newaddress form .item .under-TX {
  font-size: 10px;
  color: #989898;
}
@media screen and (min-width: 768px) {
  .my-newaddress form .item .under-TX {
    margin-top: 5px;
  }
}
@media screen and (max-width: 767px) {
  .my-newaddress form .item .under-TX {
    margin-top: 10px;
  }
}
.my-newaddress form .item .content {
  margin-top: 4px;
  display: flex;
  flex-direction: row;
}
@media screen and (min-width: 768px) {
  .my-newaddress form .item .content {
    gap: 10px;
  }
}
@media screen and (max-width: 767px) {
  .my-newaddress form .item .content {
    gap: 5px;
  }
}
.my-newaddress form .item .content input, .my-newaddress form .item .content select {
  border: none;
  height: 46px;
  color: #585D5F;
}
.my-newaddress form .item .content input::placeholder, .my-newaddress form .item .content select::placeholder {
  color: #989898;
  font-size: 13px;
  letter-spacing: 1.3px;
}
.my-newaddress form .item .content .name, .my-newaddress form .item .content .address-item, .my-newaddress form .item .content .number {
  width: 100%;
  padding-left: 12px;
}
@media screen and (min-width: 768px) {
  .my-newaddress form .item .content .address-number {
    width: 8.2742316785%;
  }
}
@media screen and (max-width: 767px) {
  .my-newaddress form .item .content .address-number {
    width: 17.9487179487%;
  }
}
.my-newaddress form .item .content .address-numberbtn {
  background: #A8DAE9;
  border-radius: 5px;
  padding: 10px 33px 8px 17px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  margin-left: auto;
  display: inline-block;
}
.my-newaddress form .item .content .address-numberbtn .TX {
  color: #FFFFFF;
  font-size: 13px;
  line-height: normal;
  position: relative;
}
.my-newaddress form .item .content .address-numberbtn .TX::before {
  content: "";
  position: absolute;
  border-right: 1px solid;
  border-bottom: 1px solid;
  width: 8px;
  height: 8px;
  rotate: -45deg;
  top: 50%;
  translate: 0 -50%;
  right: -15px;
}
.my-newaddress form .item .content.address-form {
  flex-direction: column;
}
@media screen and (min-width: 768px) {
  .my-newaddress form .item .content.number {
    gap: 21px;
  }
}
@media screen and (max-width: 767px) {
  .my-newaddress form .item .content.number {
    gap: 10px;
  }
}
@media screen and (min-width: 768px) {
  .my-newaddress form .C_btn {
    width: 450px;
    margin: 60px auto 0;
  }
}
@media screen and (max-width: 767px) {
  .my-newaddress form .C_btn {
    font-size: 15px;
    width: 183px;
    height: 58px;
    margin: 30px auto 0;
  }
}
.my-newaddress form .C_btn input {
  background: none;
  border: none;
  outline: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  color: #FFFFFF;
  width: 100%;
}

/* -----------------------
  my-newaddress-check
----------------------- */
.my-newaddress-check .C_specifications {
  padding: 0;
}
@media screen and (min-width: 768px) {
  .my-newaddress-check .C_specifications {
    margin: 100px auto 0;
    width: 78.6363636364%;
  }
}
@media screen and (max-width: 767px) {
  .my-newaddress-check .C_specifications {
    margin-top: 35px;
  }
}
.my-newaddress-check .btn-box {
  display: flex;
  flex-direction: row-reverse;
  justify-content: center;
}
@media screen and (min-width: 768px) {
  .my-newaddress-check .btn-box {
    margin: 100px auto 0;
    gap: 23px;
    width: 78.6363636364%;
  }
}
@media screen and (max-width: 767px) {
  .my-newaddress-check .btn-box {
    margin-top: 60px;
    gap: 15px;
  }
}
@media screen and (min-width: 768px) {
  .my-newaddress-check .btn-box .C_btn_wrap {
    height: 70px;
  }
}
@media screen and (max-width: 767px) {
  .my-newaddress-check .btn-box .C_btn_wrap {
    height: 50px;
  }
}
.my-newaddress-check .btn-box .C_btn_wrap input {
  width: 100%;
}
@media screen and (min-width: 768px) {
  .my-newaddress-check .btn-box .C_btn_wrap.wrap-1 {
    width: 61.7052023121%;
  }
}
@media screen and (max-width: 767px) {
  .my-newaddress-check .btn-box .C_btn_wrap.wrap-1 {
    width: 43.4285714286%;
    min-width: 140px;
  }
}
.my-newaddress-check .btn-box .C_btn_wrap.wrap-1 .btn-wrap::after {
  display: none;
}
@media screen and (min-width: 768px) {
  .my-newaddress-check .btn-box .C_btn_wrap.wrap-2 {
    width: 34.9710982659%;
  }
}
@media screen and (max-width: 767px) {
  .my-newaddress-check .btn-box .C_btn_wrap.wrap-2 {
    width: 43.4285714286%;
    min-width: initial;
  }
}
.my-newaddress-check .btn-box .C_btn_wrap.wrap-2 .btn-wrap::after {
  border-color: #FFFFFF;
}
@media screen and (min-width: 768px) {
  .my-newaddress-check .btn-box .C_btn_wrap.wrap-2 .btn-wrap::after {
    left: 50px;
  }
}
@media screen and (max-width: 767px) {
  .my-newaddress-check .btn-box .C_btn_wrap.wrap-2 .btn-wrap::after {
    left: 35px;
  }
}
.my-newaddress-check .btn-box .C_btn {
  width: 100%;
  border: none;
}
.my-newaddress-check .btn-box .C_btn input {
  background: none;
  border: none;
  outline: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  color: #FFFFFF;
}

/* -----------------------
  top
----------------------- */
#topCarrousel {
  background-color: #FFFFFF;
}

.top .top-TX {
  text-align: center;
  font-size: 16px;
  letter-spacing: 1.6px;
  line-height: 2.1;
  color: #989898;
}
@media screen and (min-width: 768px) {
  .top .top-TX {
    max-width: 670px;
    margin: 60px auto 0;
  }
}
@media screen and (max-width: 767px) {
  .top .top-TX {
    width: 90%;
    margin: 43px auto 0;
  }
}
.top .main_supports {
  margin-top: 100px !important;
}

/* -----------------------
  C_example
----------------------- */
/* -----------------------
  C_TL
----------------------- */
@media screen and (min-width: 768px) {
  .C_TL .icon {
    background-image: url('data:image/svg+xml;utf-8,<svg width="62" height="29" viewBox="0 0 62 29" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.09471 8.19193C6.20224 8.06903 6.34801 8 6.5 8C6.65199 8 6.79776 8.06903 6.90529 8.19193C7.30524 8.64957 8.81247 10.4792 10.2241 12.8436C11.6182 15.179 13 18.1655 13 20.906C13 23.567 12.2988 25.6084 11.0959 26.9848C9.89682 28.3586 8.25806 29 6.5 29C4.74194 29 3.10394 28.3586 1.90412 26.9848C0.701235 25.6084 0 23.5661 0 20.906C0 18.1655 1.38182 15.179 2.77588 12.8436C4.18753 10.4792 5.69477 8.64957 6.09471 8.19193Z" fill="%2390D8EB"/><path d="M55.0947 8.19193C55.2022 8.06903 55.348 8 55.5 8C55.652 8 55.7978 8.06903 55.9053 8.19193C56.3052 8.64957 57.8125 10.4792 59.2241 12.8436C60.6182 15.179 62 18.1655 62 20.906C62 23.567 61.2988 25.6084 60.0959 26.9848C58.8968 28.3586 57.2581 29 55.5 29C53.7419 29 52.1039 28.3586 50.9041 26.9848C49.7012 25.6084 49 23.5661 49 20.906C49 18.1655 50.3818 15.179 51.7759 12.8436C53.1875 10.4792 54.6948 8.64957 55.0947 8.19193Z" fill="%2390D8EB"/><path d="M29.9076 0.265043C30.0648 0.0953276 30.2779 0 30.5 0C30.7221 0 30.9352 0.0953276 31.0924 0.265043C31.6769 0.897019 33.8798 3.42371 35.9429 6.68872C37.9804 9.91385 40 14.038 40 17.8226C40 21.4973 38.9751 24.3164 37.2171 26.2171C35.4646 28.1143 33.0695 29 30.5 29C27.9305 29 25.5365 28.1143 23.7829 26.2171C22.0249 24.3164 21 21.496 21 17.8226C21 14.038 23.0196 9.91385 25.0571 6.68872C27.1202 3.42371 29.3231 0.897019 29.9076 0.265043Z" fill="%2390D8EB"/></svg>');
    background-size: contain;
    background-position: center;
    background-repeat: no-repeat;
    width: 62px;
    height: 29px;
    margin: 0 auto;
  }
  .C_TL .TL {
    font-family: "yu-mincho-pr6n", sans-serif;
    font-weight: 400;
    font-style: normal;
    font-weight: 800;
    text-shadow: 0 0 0.5px;
    text-align: center;
    margin-top: 13px;
    font-size: 25px;
    color: #585D5F;
    letter-spacing: 1.8;
  }
}
@media screen and (max-width: 767px) {
  .C_TL .icon {
    background-image: url('data:image/svg+xml;utf-8,<svg width="62" height="29" viewBox="0 0 62 29" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.09471 8.19193C6.20224 8.06903 6.34801 8 6.5 8C6.65199 8 6.79776 8.06903 6.90529 8.19193C7.30524 8.64957 8.81247 10.4792 10.2241 12.8436C11.6182 15.179 13 18.1655 13 20.906C13 23.567 12.2988 25.6084 11.0959 26.9848C9.89682 28.3586 8.25806 29 6.5 29C4.74194 29 3.10394 28.3586 1.90412 26.9848C0.701235 25.6084 0 23.5661 0 20.906C0 18.1655 1.38182 15.179 2.77588 12.8436C4.18753 10.4792 5.69477 8.64957 6.09471 8.19193Z" fill="%2390D8EB"/><path d="M55.0947 8.19193C55.2022 8.06903 55.348 8 55.5 8C55.652 8 55.7978 8.06903 55.9053 8.19193C56.3052 8.64957 57.8125 10.4792 59.2241 12.8436C60.6182 15.179 62 18.1655 62 20.906C62 23.567 61.2988 25.6084 60.0959 26.9848C58.8968 28.3586 57.2581 29 55.5 29C53.7419 29 52.1039 28.3586 50.9041 26.9848C49.7012 25.6084 49 23.5661 49 20.906C49 18.1655 50.3818 15.179 51.7759 12.8436C53.1875 10.4792 54.6948 8.64957 55.0947 8.19193Z" fill="%2390D8EB"/><path d="M29.9076 0.265043C30.0648 0.0953276 30.2779 0 30.5 0C30.7221 0 30.9352 0.0953276 31.0924 0.265043C31.6769 0.897019 33.8798 3.42371 35.9429 6.68872C37.9804 9.91385 40 14.038 40 17.8226C40 21.4973 38.9751 24.3164 37.2171 26.2171C35.4646 28.1143 33.0695 29 30.5 29C27.9305 29 25.5365 28.1143 23.7829 26.2171C22.0249 24.3164 21 21.496 21 17.8226C21 14.038 23.0196 9.91385 25.0571 6.68872C27.1202 3.42371 29.3231 0.897019 29.9076 0.265043Z" fill="%2390D8EB"/></svg>');
    background-size: contain;
    background-position: center;
    background-repeat: no-repeat;
    width: 43px;
    height: 20px;
    margin: 0 auto;
  }
  .C_TL .TL {
    font-family: "yu-mincho-pr6n", sans-serif;
    font-weight: 400;
    font-style: normal;
    font-weight: 800;
    text-shadow: 0 0 0.5px;
    text-align: center;
    margin-top: 13px;
    font-size: 23px;
    color: #585D5F;
    letter-spacing: 1.8;
  }
}
@media screen and (min-width: 768px) {
  .padding {
    padding-inline: 200px;
  }
}
@media screen and (max-width: 767px) {
  .padding {
    padding-inline: 20px;
  }
}

/* -----------------------
  C_btn
----------------------- */
.C_btn {
  display: block;
  background-color: #57C6EA;
  color: #FFFFFF;
  height: 70px;
  width: 450px;
  display: grid;
  place-items: center center;
}
@media screen and (min-width: 768px) {
  .C_btn {
    border-radius: 5px;
  }
}
@media screen and (max-width: 767px) {
  .C_btn {
    border-radius: 5px;
    width: 227px;
  }
}
.C_btn .TX {
  text-align: center;
  letter-spacing: 0.1em;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
}
@media screen and (min-width: 768px) {
  .C_btn .TX {
    font-size: 20px;
  }
}
@media screen and (max-width: 767px) {
  .C_btn .TX {
    font-size: 20px;
    line-height: 1.5;
  }
}
.C_btn.gray {
  background-color: #D1D1D1;
}
@media screen and (max-width: 767px) {
  .C_btn.gray .TX {
    font-size: 15px;
  }
}
.C_btn.round {
  border-radius: 60px;
  background: #A8DAE9;
}
.C_btn.round.yellow {
  background-color: #EED06E;
}
@media screen and (min-width: 768px) {
  .C_btn.round.yellow .TX {
    font-size: 23px;
  }
}
@media screen and (max-width: 767px) {
  .C_btn.round.yellow .TX {
    font-size: 23px;
  }
}
.C_btn:hover {
  color: #FFFFFF;
}

/* -----------------------
  C_specifications
----------------------- */
@media screen and (min-width: 768px) {
  .C_specifications {
    padding: 0 15%;
  }
}
@media screen and (max-width: 767px) {
  .C_specifications {
    padding: 0 5%;
  }
}
.C_specifications li {
  display: flex;
  max-width: 880px;
  margin: 0 auto;
}
.C_specifications li .TL {
  background: #A8DAE9;
  color: #FFFFFF;
  display: grid;
  place-items: center center;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  font-size: 15px;
}
@media screen and (min-width: 768px) {
  .C_specifications li .TL {
    padding: 20px 0;
    width: 150px;
  }
}
@media screen and (max-width: 767px) {
  .C_specifications li .TL {
    padding: 15px 0;
    width: 114px;
  }
}
.C_specifications li .TX {
  background: #F3F9FB;
  color: #585D5F;
  flex: 1;
  line-height: 1.5;
  font-size: 15px;
}
@media screen and (min-width: 768px) {
  .C_specifications li .TX {
    padding: 20px 44px;
  }
}
@media screen and (max-width: 767px) {
  .C_specifications li .TX {
    padding: 15px 11.4406779661%;
  }
}

/* -----------------------
  C_flow
----------------------- */
.C_flow {
  margin: 0 auto;
}
@media screen and (min-width: 768px) {
  .C_flow {
    width: 785px;
  }
}
@media screen and (max-width: 767px) {
  .C_flow {
    width: 90%;
  }
}
.C_flow .flow-item {
  display: flex;
  justify-content: space-between;
  position: relative;
  margin: 0 auto;
  counter-reset: flow;
}
.C_flow .flow-item li {
  position: relative;
  font-size: 15px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  color: #989898;
  letter-spacing: 1.5px;
}
@media screen and (max-width: 460px) {
  .C_flow .flow-item li {
    font-size: 10px;
  }
}
.C_flow .flow-item li::before {
  content: "";
  position: absolute;
  border-radius: 10px;
  background: #FFFFFF;
  left: 50%;
  translate: -50% 0;
  border: 3px solid #EBFAFF;
  width: 12px;
  height: 12px;
}
@media screen and (min-width: 768px) {
  .C_flow .flow-item li::before {
    top: -22px;
  }
}
@media screen and (max-width: 767px) {
  .C_flow .flow-item li::before {
    top: -19px;
  }
}
.C_flow .flow-item li::after {
  counter-increment: flow;
  content: counter(flow);
  position: absolute;
  background: #EBFAFF;
  color: #989898;
  border-radius: 50%;
  text-align: center;
  left: 50%;
  translate: -50% 0;
  font-size: 16px;
  line-height: 30px;
  width: 30px;
  height: 30px;
  font-weight: 800;
  text-shadow: 0 0 0.5px;
}
@media screen and (min-width: 768px) {
  .C_flow .flow-item li::after {
    top: -70px;
  }
}
@media screen and (max-width: 767px) {
  .C_flow .flow-item li::after {
    top: -65px;
  }
}
.C_flow .flow-item li.current {
  color: #585D5F;
}
.C_flow .flow-item li.current::before {
  background: #57C6EA;
  border: 3px solid #57C6EA;
}
.C_flow .flow-item li.current::after {
  background: #57C6EA;
  color: #FFFFFF;
}
.C_flow .flow-item::before {
  content: "";
  border: 2px solid #EBFAFF;
  position: absolute;
  left: 50%;
  translate: -50% 0;
}
@media screen and (min-width: 768px) {
  .C_flow .flow-item::before {
    width: 700px;
    top: -17px;
  }
}
@media screen and (max-width: 767px) {
  .C_flow .flow-item::before {
    top: -15px;
    width: 85.7%;
  }
}

/* -----------------------
  C_buying-guid-TL
----------------------- */
.C_buying-guid-TL {
  position: relative;
  letter-spacing: 1.5px;
  font-size: 19px;
}
.C_buying-guid-TL .TL {
  font-weight: 700;
  text-shadow: 0 0 0.5px;
}
.C_buying-guid-TL .C_line {
  position: absolute;
  left: 0;
  bottom: -15px;
}

/* -----------------------
  C_mypageMenu
----------------------- */
.C_mypageMenu {
  display: flex;
  margin-top: 60px;
}
@media screen and (min-width: 768px) {
  .C_mypageMenu {
    gap: 11px;
    justify-content: center;
  }
}
@media screen and (max-width: 767px) {
  .C_mypageMenu {
    max-width: 350px;
    gap: 10px 5px;
    flex-wrap: wrap;
    margin-inline: auto;
  }
}
.C_mypageMenu .btn {
  background: #A8DAE9;
  border-radius: 20px;
  text-align: center;
  color: #FFFFFF;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
}
@media screen and (min-width: 768px) {
  .C_mypageMenu .btn {
    width: 140px;
    font-size: 12px;
    padding: 4px 0;
  }
}
@media screen and (max-width: 767px) {
  .C_mypageMenu .btn {
    width: 32%;
    font-size: 10px;
    padding: 2px 0;
  }
}
.C_mypageMenu .btn.current {
  background: #57C6EA;
}

/* -----------------------
  C_line
----------------------- */
.C_line {
  background-image: url('data:image/svg+xml;utf-8,<svg width="884" height="4" viewBox="0 0 884 4" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 2L882 2.00008" stroke="%23A9DAEA" stroke-width="3" stroke-linecap="round" stroke-dasharray="1 7"/></svg>');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  background-repeat: repeat-x;
  width: 100%;
  height: 3px;
}

/* -----------------------
  line-up
----------------------- */
@media screen and (min-width: 768px) {
  .line-up .main_item {
    margin-top: 100px;
    display: flex;
    flex-direction: column;
    gap: 30px;
  }
}
@media screen and (max-width: 767px) {
  .line-up .main_item {
    margin-top: 60px;
    display: flex;
    flex-direction: column;
    gap: 60px;
  }
}
.line-up .main_item--detail {
  position: relative;
}
.line-up .main_item--detail img {
  width: 100%;
  object-fit: cover;
  object-position: center;
}
@media screen and (min-width: 768px) {
  .line-up .main_item--detail img {
    height: 448px;
  }
}
@media screen and (max-width: 767px) {
  .line-up .main_item--detail img {
    height: 222px;
  }
}
.line-up .main_item--detail .text_box {
  background: #FFF;
}
@media screen and (min-width: 768px) {
  .line-up .main_item--detail .text_box {
    width: 477px;
    position: absolute;
    top: 50%;
    left: 106px;
    translate: 0 -50%;
    padding: 42px 29px 29px 29px;
  }
}
@media screen and (max-width: 767px) {
  .line-up .main_item--detail .text_box {
    padding: 30px 20px 0;
  }
}
.line-up .main_item--detail .text_box .title {
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.line-up .main_item--detail .text_box .title .TL {
  color: #585D5F;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: normal;
  font-family: "yu-gothic-pr6n", sans-serif;
  font-weight: 400;
  font-style: normal;
  font-size: 20px;
}
.line-up .main_item--detail .text_box .title .tags {
  display: flex;
  gap: 11px;
}
.line-up .main_item--detail .text_box .title .tags .TX {
  border-radius: 100px;
  background: #EBFAFF;
  width: fit-content;
  color: #57C6EA;
  font-family: "yu-gothic-pr6n", sans-serif;
  font-weight: 400;
  font-style: normal;
  font-weight: 500;
  line-height: normal;
  padding: 3px 13px;
  font-size: 13px;
}
.line-up .main_item--detail .text_box .text {
  margin-top: 30px;
}
.line-up .main_item--detail .text_box .text .TX {
  font-family: "yu-gothic-pr6n", sans-serif;
  font-weight: 400;
  font-style: normal;
  color: #585D5F;
  font-weight: 500;
  line-height: 1.5;
  font-size: 15px;
  letter-spacing: 0.75px;
}
.line-up .main_item--detail .text_box .C_view_more {
  margin: 28px 0 0 auto;
}
.line-up .main_item--contents .contents--inner {
  display: flex;
  flex-wrap: wrap;
}
@media screen and (min-width: 768px) {
  .line-up .main_item--contents .contents--inner {
    gap: 25px;
  }
}
@media screen and (max-width: 767px) {
  .line-up .main_item--contents .contents--inner {
    gap: 30px 16px;
    justify-content: center;
    padding-inline: 20px;
  }
}
.line-up .main_item--contents .contents--inner img {
  object-fit: cover;
  object-position: center;
}
@media screen and (min-width: 768px) {
  .line-up .main_item--contents .contents--inner img {
    width: 250px;
    height: 250px;
  }
}
@media screen and (max-width: 767px) {
  .line-up .main_item--contents .contents--inner img {
    width: 167px;
    height: 167px;
  }
}
.line-up .main_supports {
  background-size: cover;
}
@media screen and (min-width: 768px) {
  .line-up .main_supports {
    background-position: center;
    padding: 66px 0 57px;
    margin-top: 200px;
  }
}
@media screen and (max-width: 767px) {
  .line-up .main_supports {
    padding: 47px 45px;
    margin-top: 160px;
  }
}
.line-up .main_supports-container {
  background: #FFF;
}
@media screen and (min-width: 768px) {
  .line-up .main_supports-container {
    max-width: 880px;
    width: 90%;
    margin: 0 auto;
    padding: 38px 0 30px;
  }
}
@media screen and (max-width: 767px) {
  .line-up .main_supports-container {
    padding: 39px 10px;
  }
}
.line-up .main_supports-container .title {
  text-align: center;
}
@media screen and (min-width: 768px) {
  .line-up .main_supports-container .title {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
}
@media screen and (max-width: 767px) {
  .line-up .main_supports-container .title {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }
}
.line-up .main_supports-container .title .TX {
  border-radius: 100px;
  background: #EBFAFF;
  width: fit-content;
  margin: 0 auto;
  color: #57C6EA;
  font-weight: 500;
  line-height: 1.5;
  font-size: 13px;
  padding: 2px 13px 3px;
}
.line-up .main_supports-container .title .TL {
  color: #585D5F;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  font-size: 20px;
  text-align: center;
}
.line-up .main_supports-container .text {
  text-align: center;
}
@media screen and (min-width: 768px) {
  .line-up .main_supports-container .text {
    margin: 30px auto 0;
    width: 497px;
  }
}
@media screen and (max-width: 767px) {
  .line-up .main_supports-container .text {
    margin: 60px auto 0;
    width: 90%;
  }
}
.line-up .main_supports-container .text .TX {
  color: #585D5F;
  font-size: 15px;
  font-weight: 500;
  line-height: 150%;
  letter-spacing: 1.5px;
}
.line-up .main_supports-container .contents {
  text-align: center;
  display: flex;
}
@media screen and (min-width: 768px) {
  .line-up .main_supports-container .contents {
    justify-content: space-between;
    max-width: 610px;
    width: 95%;
    margin: 42px auto 0;
    gap: 20px;
  }
}
@media screen and (max-width: 767px) {
  .line-up .main_supports-container .contents {
    flex-direction: column;
    gap: 50px;
    align-items: center;
    margin-top: 30px;
  }
}
.line-up .main_supports-container .contents .contents-card {
  display: flex;
  justify-content: center;
  align-items: center;
  background-image: url('data:image/svg+xml;utf-8,<svg xmlns="http://www.w3.org/2000/svg" width="73" height="102" viewBox="0 0 73 102" fill="none"><path d="M73 65.1325C73 85.4939 57.9983 102 36.629 102C15.2597 102 0 85.4939 0 65.1325C0 44.7712 36.629 0 36.629 0C36.629 0 73 44.7712 73 65.1325Z" fill="%23EBFAFF"/></svg>');
  background-size: contain;
  background-position: center;
  background-repeat: no-repeat;
  width: 190px;
  height: 102px;
}
.line-up .main_supports-container .contents .contents-card .TX {
  color: #989898;
  font-size: 15px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  letter-spacing: 1.5px;
  white-space: nowrap;
}
@media screen and (min-width: 768px) {
  .line-up .main_supports-container .C_view_more {
    margin: 26px 44px 0 auto;
  }
}
@media screen and (max-width: 767px) {
  .line-up .main_supports-container .C_view_more {
    margin: 59px auto 0;
  }
}

/* -----------------------
  product-detail
----------------------- */
.product-detail {
  padding-top: 9px;
  margin-bottom: 0;
}
@media screen and (max-width: 767px) {
  .product-detail {
    padding-inline: 20px;
  }
}
.product-detail .breadcrumb-list {
  display: flex;
  flex-wrap: wrap;
}
@media screen and (min-width: 768px) {
  .product-detail .breadcrumb-list {
    gap: 3px;
    margin-bottom: 127px;
  }
}
@media screen and (max-width: 767px) {
  .product-detail .breadcrumb-list {
    padding-left: 18px;
    gap: 3px;
    margin-bottom: 60px;
  }
}
.product-detail .breadcrumb-list p {
  color: #8B9396;
  font-weight: 500;
  line-height: normal;
}
@media screen and (min-width: 768px) {
  .product-detail .breadcrumb-list p {
    font-size: 13px;
    letter-spacing: 1.3px;
  }
}
@media screen and (max-width: 767px) {
  .product-detail .breadcrumb-list p {
    font-size: 10px;
    letter-spacing: 1px;
  }
}
.product-detail_main {
  display: flex;
}
@media screen and (min-width: 768px) {
  .product-detail_main {
    gap: 50px;
  }
}
@media screen and (max-width: 767px) {
  .product-detail_main {
    flex-direction: column;
  }
}
@media screen and (min-width: 768px) {
  .product-detail_main .product_img {
    width: min(445px, 34.765625vw);
    flex-shrink: 0;
  }
}
@media screen and (max-width: 767px) {
  .product-detail_main .product_img {
    margin-top: 30px;
  }
}
.product-detail_main .product_img img {
  width: 100%;
  border-radius: 5px;
  box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.15);
}
@media screen and (min-width: 768px) {
  .product-detail_main .product_img-thumbnail {
    margin-bottom: 26px;
  }
}
@media screen and (max-width: 767px) {
  .product-detail_main .product_img-thumbnail {
    margin-bottom: 25px;
  }
}
.product-detail_main .product_img-other {
  display: flex;
  flex-wrap: wrap;
}
@media screen and (min-width: 768px) {
  .product-detail_main .product_img-other {
    gap: 20px;
  }
}
@media screen and (max-width: 767px) {
  .product-detail_main .product_img-other {
    gap: 16px;
  }
}
@media screen and (min-width: 768px) {
  .product-detail_main .product_img-other .other-item {
    width: 95px;
  }
}
@media screen and (max-width: 767px) {
  .product-detail_main .product_img-other .other-item {
    width: 75px;
  }
}
.product-detail_main .product_img-other .other-item img {
  cursor: pointer;
}
@media screen and (min-width: 768px) {
  .product-detail_main .product_name {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
}
@media screen and (max-width: 767px) {
  .product-detail_main .product_name {
    display: flex;
    flex-direction: column;
    gap: 7px;
  }
}
.product-detail_main .product_name .TL {
  color: #585D5F;
  font-size: 20px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  text-align: left;
}
.product-detail_main .product_name .tags {
  text-align: center;
  display: flex;
  gap: 11px;
}
.product-detail_main .product_name .tags .TX {
  border-radius: 100px;
  background: #EBFAFF;
  width: fit-content;
  color: #57C6EA;
  font-family: "yu-gothic-pr6n", sans-serif;
  font-weight: 400;
  font-style: normal;
  font-weight: 500;
  line-height: 1.5;
  padding: 3px 13px;
  font-size: 13px;
}
@media screen and (min-width: 768px) {
  .product-detail_main .product_container .product_content {
    margin-top: 28px;
  }
}
@media screen and (max-width: 767px) {
  .product-detail_main .product_container .product_content {
    margin-top: 60px;
  }
}
.product-detail_main .product_container .product_content .TX {
  color: #585D5F;
  font-size: 15px;
  font-weight: 500;
  line-height: 1.5;
}
.product-detail_main .product_container .product_content .TX span {
  font-weight: 700;
  text-shadow: 0 0 0.5px;
}
.product-detail_main .product_container .product_control {
  background: #F3F9FB;
  border-top: dotted 1px #A9DAEA;
}
@media screen and (min-width: 768px) {
  .product-detail_main .product_container .product_control {
    margin-top: 13px;
    padding: 21px 21px 45px;
  }
}
@media screen and (max-width: 767px) {
  .product-detail_main .product_container .product_control {
    margin-top: 60px;
    padding: 21px 22px 30px;
  }
}
.product-detail_main .product_container .product_control-list {
  display: flex;
  flex-direction: column;
  gap: 28px;
}
.product-detail_main .product_container .product_control-list-item {
  display: flex;
  align-items: center;
  gap: 25px;
}
.product-detail_main .product_container .product_control-list-item .item-title {
  flex-shrink: 0;
}
.product-detail_main .product_container .product_control-list-item .item-title .TL,
.product-detail_main .product_container .product_control-list-item .item-title label {
  color: #515151;
  font-size: 15px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  letter-spacing: 0.6px;
}
.product-detail_main .product_container .product_control-list-item .item-in .TX {
  color: #515151;
  font-size: 24px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  letter-spacing: 0.96px;
}
.product-detail_main .product_container .product_control-list-item .item-in .TX span {
  color: #515151;
  font-size: 15px;
  font-weight: 500;
  letter-spacing: 0.6px;
}
.product-detail_main .product_container .product_control-list-item .item-in select {
  border-radius: 5px;
  border: 2px solid #AAA;
  background: #FFF;
}
.product-detail_main .product_container .product_control .C_btn {
  width: 100%;
  border: none;
  text-align: center;
  letter-spacing: 0.1em;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
}
@media screen and (min-width: 768px) {
  .product-detail_main .product_container .product_control .C_btn {
    margin-top: 70px;
  }
}
@media screen and (max-width: 767px) {
  .product-detail_main .product_container .product_control .C_btn {
    margin-top: 60px;
  }
}
@media screen and (min-width: 768px) {
  .product-detail_main .product_container .product_control .C_btn {
    font-size: 20px;
  }
}
@media screen and (max-width: 767px) {
  .product-detail_main .product_container .product_control .C_btn {
    font-size: 20px;
    line-height: 1.5;
  }
}
@media screen and (min-width: 768px) {
  .product-detail_specification {
    margin-top: 100px;
  }
}
@media screen and (max-width: 767px) {
  .product-detail_specification {
    margin-top: 60px;
  }
}
.product-detail_specification .title {
  padding-left: 34px;
}
@media screen and (min-width: 768px) {
  .product-detail_specification .title {
    margin-bottom: 20px;
  }
}
@media screen and (max-width: 767px) {
  .product-detail_specification .title {
    margin-bottom: 25px;
  }
}
.product-detail_specification .title .TL {
  color: #585D5F;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: normal;
  font-size: 20px;
}
.product-detail_specification .C_specifications {
  padding: unset;
}

/* -----------------------
  product-cart
----------------------- */
@media screen and (min-width: 768px) {
  .product-cart {
    padding-top: 133px;
  }
}
@media screen and (max-width: 767px) {
  .product-cart {
    padding: 90px 20px 0;
  }
}
.product-cart .C_flow {
  width: 100%;
}
@media screen and (min-width: 768px) {
  .product-cart .C_flow .flow-item::before {
    width: 90%;
    top: -17px;
  }
}
@media screen and (max-width: 767px) {
  .product-cart .C_flow .flow-item::before {
    width: 87%;
  }
}
@media screen and (min-width: 768px) {
  .product-cart .shopping-cart {
    margin-top: 100px;
  }
}
@media screen and (max-width: 767px) {
  .product-cart .shopping-cart {
    margin-top: 60px;
  }
}
.product-cart .shopping-cart .cart-in {
  margin-top: 62px;
}
.product-cart .shopping-cart .cart-in .all__delete {
  padding: 0 13px 14px;
}
.product-cart .shopping-cart .cart-in .all__delete a {
  display: block;
  color: #FFF;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  border-radius: 100px;
  background: #757575;
  width: fit-content;
  font-size: 14px;
  letter-spacing: 0.56px;
  padding: 2px 18px;
  margin-left: auto;
}
.product-cart .shopping-cart .cart-in .cart--items .shopping--item {
  background: #F3F9FB;
  position: relative;
  border-top: dashed 3px #A9DAEA;
}
.product-cart .shopping-cart .cart-in .cart--items .shopping--item:last-child {
  border-bottom: dashed 3px #A9DAEA;
}
@media screen and (min-width: 768px) {
  .product-cart .shopping-cart .cart-in .cart--items .shopping--item {
    padding: 34px 13px 34px 49px;
  }
}
@media screen and (max-width: 767px) {
  .product-cart .shopping-cart .cart-in .cart--items .shopping--item {
    padding: 30px 35px 47px;
  }
}
.product-cart .shopping-cart .cart-in .cart--items .shopping--item--inner {
  display: flex;
}
@media screen and (min-width: 768px) {
  .product-cart .shopping-cart .cart-in .cart--items .shopping--item--inner {
    align-items: center;
    justify-content: space-between;
  }
}
@media screen and (max-width: 767px) {
  .product-cart .shopping-cart .cart-in .cart--items .shopping--item--inner {
    flex-direction: column;
    gap: 37px;
  }
}
.product-cart .shopping-cart .cart-in .cart--items .shopping--item--inner_variation {
  display: flex;
}
@media screen and (min-width: 768px) {
  .product-cart .shopping-cart .cart-in .cart--items .shopping--item--inner_variation {
    gap: 36px;
  }
}
@media screen and (max-width: 767px) {
  .product-cart .shopping-cart .cart-in .cart--items .shopping--item--inner_variation {
    flex-direction: column;
    gap: 37px;
  }
}
.product-cart .shopping-cart .cart-in .cart--items .shopping--item--inner_variation img {
  border-radius: 5px;
  flex-shrink: 0;
  object-fit: contain;
  object-position: center;
}
@media screen and (min-width: 768px) {
  .product-cart .shopping-cart .cart-in .cart--items .shopping--item--inner_variation img {
    width: 202px;
    height: 202px;
  }
}
@media screen and (max-width: 767px) {
  .product-cart .shopping-cart .cart-in .cart--items .shopping--item--inner_variation img {
    aspect-ratio: 1/1;
    width: 100%;
    max-width: 400px;
    margin: 0 auto;
  }
}
.product-cart .shopping-cart .cart-in .cart--items .shopping--item--inner_variation .variation_name {
  display: flex;
  flex-direction: column;
  gap: 30px;
}
@media screen and (min-width: 768px) {
  .product-cart .shopping-cart .cart-in .cart--items .shopping--item--inner_variation .variation_name {
    padding-top: 10px;
  }
}
.product-cart .shopping-cart .cart-in .cart--items .shopping--item--inner_variation .variation_name .TL {
  color: #585D5F;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  font-size: 20px;
}
.product-cart .shopping-cart .cart-in .cart--items .shopping--item--inner_contents {
  display: flex;
  align-items: center;
  flex-shrink: 0;
}
@media screen and (min-width: 768px) {
  .product-cart .shopping-cart .cart-in .cart--items .shopping--item--inner_contents {
    gap: 28px;
  }
}
@media screen and (max-width: 767px) {
  .product-cart .shopping-cart .cart-in .cart--items .shopping--item--inner_contents {
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 20px 10px;
  }
}
.product-cart .shopping-cart .cart-in .cart--items .shopping--item--inner_contents .counts {
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 7.174px;
  border: 2px solid #AAA;
  background: #FFF;
  aspect-ratio: 1/1;
  width: 55px;
}
.product-cart .shopping-cart .cart-in .cart--items .shopping--item--inner_contents .counts .TX {
  color: #515151;
  font-size: 20px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  letter-spacing: 0.8px;
}
.product-cart .shopping-cart .cart-in .cart--items .shopping--item--inner_contents .yen .TX {
  color: #515151;
  font-size: 24px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  letter-spacing: 0.96px;
}
.product-cart .shopping-cart .cart-in .cart--items .shopping--item--inner_contents .delete a {
  display: block;
  color: #FFF;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  border-radius: 100px;
  background: #757575;
  width: fit-content;
  font-size: 14px;
  letter-spacing: 0.56px;
  padding: 2px 18px;
}
.product-cart .shopping-cart .cart-in .gate {
  margin: 30px 13px 0 auto;
  width: 195px;
  display: flex;
  flex-direction: column;
  gap: 12px;
}
@media screen and (max-width: 767px) {
  .product-cart .shopping-cart .cart-in .gate {
    margin-right: 0;
  }
}
.product-cart .shopping-cart .cart-in .gate .flex-item {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
}
.product-cart .shopping-cart .cart-in .gate .postage .TX {
  color: #515151;
  font-size: 15px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  letter-spacing: 0.6px;
}
.product-cart .shopping-cart .cart-in .gate .postage .TX.TX-right {
  font-weight: 500;
}
.product-cart .shopping-cart .cart-in .gate .all_set .TX {
  color: #F27676;
  font-size: 15px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  letter-spacing: 0.6px;
}
.product-cart .shopping-cart .cart-in .gate .all_set .TX.TX-right {
  font-size: 20px;
}
@media screen and (min-width: 768px) {
  .product-cart .step__up {
    margin-top: 150px;
  }
}
@media screen and (max-width: 767px) {
  .product-cart .step__up {
    margin-top: 132px;
  }
}
@media screen and (min-width: 768px) {
  .product-cart .step__up--top {
    margin-bottom: 60px;
  }
}
@media screen and (max-width: 767px) {
  .product-cart .step__up--top {
    margin-bottom: 30px;
  }
}
.product-cart .step__up--top .TX {
  color: #585D5F;
  text-align: center;
  font-size: 20px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  letter-spacing: 2px;
}
.product-cart .step__up--inner {
  display: flex;
}
@media screen and (min-width: 768px) {
  .product-cart .step__up--inner {
    padding-inline: 20px;
    gap: 46px;
  }
}
@media screen and (max-width: 767px) {
  .product-cart .step__up--inner {
    flex-direction: column-reverse;
    gap: 60px;
  }
}
.product-cart .step__up--inner .step--item {
  border-radius: 10px;
  background: #F3F9FB;
  width: 100%;
}
@media screen and (min-width: 768px) {
  .product-cart .step__up--inner .step--item {
    padding: 57px 52px 60px;
  }
}
@media screen and (max-width: 767px) {
  .product-cart .step__up--inner .step--item {
    padding: 43px 33px 60px;
  }
}
.product-cart .step__up--inner .step--item .title {
  margin-bottom: 30px;
}
.product-cart .step__up--inner .step--item .title .TL {
  color: #585D5F;
  text-align: center;
  font-size: 20px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  letter-spacing: 2px;
}
.product-cart .step__up--inner .step--item .jump_btn {
  border-radius: 100px;
  background: #A8DAE9;
  color: #FFF;
  text-align: center;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  display: block;
  width: 100%;
  padding: 16px 0;
  letter-spacing: 2.4px;
  font-size: 20px;
  border: unset;
}
.product-cart .step__up--inner .step--item .inputs {
  display: flex;
  flex-direction: column;
  gap: 10px;
  margin-bottom: 30px;
}
.product-cart .step__up--inner .step--item .inputs--item {
  display: flex;
  flex-direction: column;
  gap: 3px;
}
.product-cart .step__up--inner .step--item .inputs--item label {
  color: #585D5F;
  font-size: 15px;
  font-weight: 500;
  line-height: 1.5;
  letter-spacing: 1.5px;
}
.product-cart .step__up--inner .step--item .inputs--item input {
  height: 36px;
  background: #FFF;
  border: unset;
}
.product-cart .step__up--inner .step--item .text {
  margin-top: 30px;
  display: flex;
  flex-direction: column;
  gap: 25px;
}
.product-cart .step__up--inner .step--item .text .TX {
  color: #585D5F;
  font-size: 12px;
  font-weight: 500;
  line-height: 1.5;
  letter-spacing: 1.2px;
}
.product-cart .step__up--inner .step--item .text a.TX {
  color: #57C6EA;
  text-decoration-line: underline;
}

/* -----------------------
  product-form
----------------------- */
@media screen and (min-width: 768px) {
  .product-form {
    padding-top: 133px;
  }
}
@media screen and (max-width: 767px) {
  .product-form {
    padding: 90px 0px 0;
  }
}
.product-form .C_flow {
  width: 100%;
}
@media screen and (min-width: 768px) {
  .product-form .C_flow .flow-item::before {
    width: 90%;
    top: -17px;
  }
}
@media screen and (max-width: 767px) {
  .product-form .C_flow .flow-item::before {
    width: 87%;
  }
}
@media screen and (min-width: 768px) {
  .product-form .shopping-form {
    margin-top: 100px;
  }
}
@media screen and (max-width: 767px) {
  .product-form .shopping-form {
    margin-top: 60px;
  }
}
.product-form .shopping-form .C_TL .TL {
  line-height: 1.5;
}
@media screen and (min-width: 768px) {
  .product-form .shopping-form-container {
    margin-top: 100px;
    display: flex;
    flex-direction: column;
    gap: 60px;
  }
}
@media screen and (max-width: 767px) {
  .product-form .shopping-form-container {
    margin-top: 60px;
    display: flex;
    flex-direction: column;
    gap: 50px;
  }
}
@media screen and (min-width: 768px) {
  .product-form .shopping-form-container .form_container-title {
    margin-bottom: 5px;
  }
}
@media screen and (max-width: 767px) {
  .product-form .shopping-form-container .form_container-title {
    margin-bottom: 5px;
  }
}
.product-form .shopping-form-container .form_container-title .TL {
  color: #989898;
  font-size: 20px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  letter-spacing: 1.6px;
}
.product-form .shopping-form-container .form_container .form_content {
  background: #F3F9FB;
}
@media screen and (min-width: 768px) {
  .product-form .shopping-form-container .form_container .form_content {
    padding: 60px 107px 68px;
  }
}
@media screen and (max-width: 767px) {
  .product-form .shopping-form-container .form_container .form_content {
    padding: 30px 20px 40px;
  }
}
@media screen and (min-width: 768px) {
  .product-form .shopping-form-container .form_container .form_content .log-in-inputs {
    margin-bottom: 30px;
    display: flex;
    flex-direction: column;
    gap: 20px;
  }
}
@media screen and (max-width: 767px) {
  .product-form .shopping-form-container .form_container .form_content .log-in-inputs {
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
    gap: 20px;
  }
}
.product-form .shopping-form-container .form_container .form_content .log-in-inputs li .TX {
  color: #989898;
  font-size: 13px;
  font-weight: 500;
  line-height: 1.5;
  letter-spacing: 1.3px;
}
.product-form .shopping-form-container .form_container .form_content .log-in-inputs li input {
  width: 100%;
  height: 46px;
  background: #FFF;
  border: unset;
}
.product-form .shopping-form-container .form_container .form_content .jump_btn {
  border-radius: 100px;
  background: #A8DAE9;
  color: #FFF;
  text-align: center;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  display: block;
  width: 100%;
  padding: 16px 0;
  letter-spacing: 2.4px;
  font-size: 20px;
  border: unset;
  height: unset;
}
.product-form .shopping-form-container .form_container .form_content .pass-end {
  margin-top: 30px;
  display: flex;
  flex-direction: column;
  gap: 25px;
  color: #57C6EA;
  font-size: 12px;
  font-weight: 500;
  line-height: 1.5;
  letter-spacing: 1.2px;
  text-decoration-line: underline;
  display: block;
  width: fit-content;
  margin-left: auto;
}
@media screen and (min-width: 768px) {
  .product-form .shopping-form-container .form_container .form_content form {
    display: flex;
    flex-direction: column;
    gap: 60px;
  }
}
@media screen and (max-width: 767px) {
  .product-form .shopping-form-container .form_container .form_content form {
    display: flex;
    flex-direction: column;
    gap: 60px;
  }
}
.product-form .shopping-form-container .form_container .form_content form input,
.product-form .shopping-form-container .form_container .form_content form select,
.product-form .shopping-form-container .form_container .form_content form textarea {
  width: 100%;
  height: 46px;
  background: #FFF;
  border: unset;
  color: #989898;
}
.product-form .shopping-form-container .form_container .form_content form input::placeholder,
.product-form .shopping-form-container .form_container .form_content form select::placeholder,
.product-form .shopping-form-container .form_container .form_content form textarea::placeholder {
  color: #989898;
}
.product-form .shopping-form-container .form_container .form_content form textarea {
  resize: none;
}
@media screen and (min-width: 768px) {
  .product-form .shopping-form-container .form_container .form_content form textarea {
    height: 200px;
  }
}
@media screen and (max-width: 767px) {
  .product-form .shopping-form-container .form_container .form_content form textarea {
    height: 160px;
  }
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item {
  display: flex;
  flex-direction: column;
  gap: 32px;
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item-title {
  border-bottom: dashed 3px #A9DAEA;
}
@media screen and (min-width: 768px) {
  .product-form .shopping-form-container .form_container .form_content form .form_content-item-title {
    padding: 0 0 5px;
  }
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item-title .TL {
  color: #989898;
  font-size: 16px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  letter-spacing: 1.6px;
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area {
  display: flex;
  flex-direction: column;
  gap: 30px;
}
@media screen and (min-width: 768px) {
  .product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area {
    padding-inline: 13px;
  }
}
@media screen and (max-width: 767px) {
  .product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area {
    padding-left: 13px;
  }
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-title {
  margin-bottom: 4px;
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-title .TX {
  color: #989898;
  font-size: 13px;
  font-weight: 500;
  line-height: 1.5;
  letter-spacing: 1.3px;
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list .check-area {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item {
  display: flex;
  align-items: center;
  gap: 10px;
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item.column {
  flex-direction: column;
}
@media screen and (max-width: 767px) {
  .product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item.column-sp {
    flex-direction: column;
    align-items: flex-start;
    gap: 17px;
  }
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item.check {
  gap: 40px;
}
@media screen and (max-width: 767px) {
  .product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item.column-check-sp {
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
  }
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item .first-check {
  flex-shrink: 0;
  border-radius: 5px;
  border: 1px solid #AEDEEE;
  background: #FFF;
  display: flex;
  justify-content: center;
  align-items: center;
  color: #AEDEEE;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  font-size: 15px;
  letter-spacing: 1.5px;
  width: 284px;
  height: 60px;
}
@media screen and (min-width: 768px) {
  .product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item .first-check {
    margin-right: 77px;
  }
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item .input-half {
  width: 100%;
  color: #989898;
  font-weight: 500;
  line-height: 1;
  font-size: 13px;
  letter-spacing: 1.3px;
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item .input-half.W_half {
  width: 70px;
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item .input-half.birthdate {
  display: flex;
  align-items: center;
  gap: 3px;
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item .input-half.birthdate:nth-child(1) {
  width: 128px;
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item .input-half.birthdate:nth-child(2) {
  width: 83px;
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item .input-half.birthdate:nth-child(3) {
  width: 83px;
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item .input-half.family {
  display: flex;
  align-items: center;
  gap: 3px;
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item .input-half.family select {
  width: 115px;
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item .input-full {
  width: 100%;
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item .input-full .TX {
  color: #989898;
  font-size: 10px;
  font-weight: 500;
  line-height: 1.5;
  letter-spacing: 1px;
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item .input-full.check {
  display: flex;
  align-items: center;
  gap: 16px;
  width: fit-content;
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item .input-full.check:has(input[type=checkbox]) {
  margin-left: auto;
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item .input-full.check input[type=radio],
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item .input-full.check input[type=checkbox] {
  width: 24px;
  height: 24px;
  border-radius: 50%;
  border: none;
  margin: 0;
  appearance: none;
  position: relative;
  flex-shrink: 0;
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item .input-full.check input[type=radio]:checked::before,
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item .input-full.check input[type=checkbox]:checked::before {
  content: "";
  width: 80%;
  height: 80%;
  background: #A8DAE9;
  border-radius: 50%;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item .input-full.check input[type=checkbox] {
  width: 14px;
  height: 14px;
  border-radius: 0;
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item .input-full.check input[type=checkbox]:checked::before {
  content: "";
  width: 80%;
  height: 30%;
  background: unset;
  border-radius: 0;
  border-bottom: solid 2px #A8DAE9;
  border-left: solid 2px #A8DAE9;
  position: absolute;
  top: 30%;
  left: 50%;
  transform: translate(-50%, -50%) rotate(-45deg);
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item .input-full.check label {
  color: #989898;
  font-weight: 500;
  line-height: 1.5;
  font-size: 13px;
  letter-spacing: 1.3px;
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item .search_description {
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 5px;
  background: #A8DAE9;
  margin-left: auto;
  width: fit-content;
  padding: 13px 17px;
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list-item .search_description a {
  color: #FFF;
  font-size: 13px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  letter-spacing: 1.3px;
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list .add-text {
  margin: 10px 0 20px;
  color: #989898;
  font-size: 13px;
  font-style: normal;
  font-weight: 500;
  line-height: 1.5;
  letter-spacing: 0.5px;
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .input-area-list .privacy_box {
  width: 100%;
  height: 200px;
  border-radius: 5px;
  background: #F2F2F2;
  box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1) inset;
  overflow-y: scroll;
  margin-top: 4px;
  padding: 1rem;
  line-height: 1.5;
  font-size: 16px;
}
.product-form .shopping-form-container .form_container .form_content form .submit-btn button {
  cursor: pointer;
  border-radius: 5px;
  background: #D1D1D1;
  color: #FFF;
  text-align: center;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  width: fit-content;
  margin: 0 auto;
  display: block;
  letter-spacing: 2px;
  font-size: 20px;
  padding: 20px 50px;
}
.product-form .shopping-form-container .form_container .form_content form .submit-btn #sub {
  background: #57C6EA !important;
}
.product-form .shopping-form-container .form_container .form_content form #submitError {
  text-align: center;
}
.product-form .shopping-form-container .form_container .form_content form #submitError button {
  color: red;
}

/* -----------------------
  product-confirm
----------------------- */
@media screen and (min-width: 768px) {
  .product-confirm {
    padding-top: 133px;
  }
}
@media screen and (max-width: 767px) {
  .product-confirm {
    padding: 90px 20px 0;
  }
}
.product-confirm .C_flow {
  width: 100%;
}
@media screen and (min-width: 768px) {
  .product-confirm .C_flow .flow-item::before {
    width: 90%;
    top: -17px;
  }
}
@media screen and (max-width: 767px) {
  .product-confirm .C_flow .flow-item::before {
    width: 87%;
  }
}
@media screen and (min-width: 768px) {
  .product-confirm .shopping-confirm {
    margin-top: 100px;
  }
}
@media screen and (max-width: 767px) {
  .product-confirm .shopping-confirm {
    margin-top: 60px;
  }
}
.product-confirm .shopping-confirm .C_TL .TL {
  line-height: 1.5;
}
@media screen and (min-width: 768px) {
  .product-confirm .shopping-confirm-container {
    margin-top: 100px;
    padding-inline: 90px;
  }
}
@media screen and (max-width: 767px) {
  .product-confirm .shopping-confirm-container {
    margin-top: 60px;
  }
}
.product-confirm .shopping-confirm-container .confirm-content_wrap {
  display: flex;
  flex-direction: column;
  gap: 60px;
}
.product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content.confirm-content_first {
  margin-bottom: 40px;
}
.product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content_title {
  border-bottom: dashed 3px #A9DAEA;
  padding-bottom: 5px;
}
.product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content_title .TL {
  color: #989898;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  font-size: 16px;
  letter-spacing: 1.6px;
}
@media screen and (min-width: 768px) {
  .product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm {
    margin-top: 60px;
  }
}
@media screen and (max-width: 767px) {
  .product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm {
    margin-top: 30px;
  }
}
.product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm_inner ul li {
  background: #F3F9FB;
  display: flex;
  border-bottom: dashed 3px #A9DAEA;
}
@media screen and (min-width: 768px) {
  .product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm_inner ul li {
    padding: 34px 38px 37px 41px;
    align-items: center;
    justify-content: space-between;
  }
}
@media screen and (max-width: 767px) {
  .product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm_inner ul li {
    padding: 30px 35px;
    flex-direction: column;
    gap: 30px;
  }
}
.product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm_inner ul li .item-detail {
  display: flex;
}
@media screen and (min-width: 768px) {
  .product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm_inner ul li .item-detail {
    gap: 36px;
  }
}
@media screen and (max-width: 767px) {
  .product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm_inner ul li .item-detail {
    flex-direction: column;
    gap: 37px;
  }
}
.product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm_inner ul li .item-detail img {
  aspect-ratio: 1;
  flex-shrink: 0;
}
@media screen and (min-width: 768px) {
  .product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm_inner ul li .item-detail img {
    width: 202px;
  }
}
@media screen and (max-width: 767px) {
  .product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm_inner ul li .item-detail img {
    width: 100%;
    max-width: 400px;
    margin: 0 auto;
  }
}
.product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm_inner ul li .item-detail-content {
  display: flex;
  flex-direction: column;
  gap: 32px;
}
@media screen and (min-width: 768px) {
  .product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm_inner ul li .item-detail-content {
    padding-top: 10px;
  }
}
.product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm_inner ul li .item-detail-content-title .TL {
  color: #585D5F;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  font-size: 20px;
}
.product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm_inner ul li .item-detail-content-text {
  display: flex;
  flex-direction: column;
  gap: 17px;
}
.product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm_inner ul li .item-detail-content-text .text-in {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  gap: 10px;
}
.product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm_inner ul li .item-detail-content-text .text-in .TL {
  color: #515151;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  font-size: 15px;
  letter-spacing: 0.6px;
  min-width: 60px;
}
.product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm_inner ul li .item-detail-content-text .text-in .TX {
  color: #989898;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  font-size: 13px;
  letter-spacing: 0.52px;
}
.product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm_inner ul li .item-price {
  flex-shrink: 0;
}
.product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm_inner ul li .item-price .TX {
  color: #515151;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  font-size: 24px;
  letter-spacing: 0.96px;
}
.product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm_inner .gate {
  margin: 30px 0 0 auto;
  width: fit-content;
  min-width: 195px;
  display: flex;
  flex-direction: column;
  gap: 12px;
}
.product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm_inner .gate .flex-item {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  gap: 10px;
}
.product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm_inner .gate .postage .TX {
  color: #515151;
  font-size: 15px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  letter-spacing: 0.6px;
}
.product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm_inner .gate .postage .TX.TX-right {
  font-weight: 500;
}
.product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm_inner .gate .all_set .TX {
  color: #F27676;
  font-size: 15px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  letter-spacing: 0.6px;
}
.product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .cart-confirm_inner .gate .all_set .TX.TX-right {
  font-size: 20px;
}
.product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .text-confirm {
  margin-top: 35px;
}
@media screen and (max-width: 767px) {
  .product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .text-confirm_content {
    padding-inline: 23px;
  }
}
.product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .text-confirm_content .TX,
.product-confirm .shopping-confirm-container .confirm-content_wrap .confirm-content .text-confirm_content div {
  color: #989898;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  letter-spacing: 1.6px;
  font-size: 16px;
}
.product-confirm .shopping-confirm-container .confirm-content_btn {
  display: flex;
}
@media screen and (min-width: 768px) {
  .product-confirm .shopping-confirm-container .confirm-content_btn {
    margin-top: 160px;
    gap: 23px;
  }
}
@media screen and (max-width: 767px) {
  .product-confirm .shopping-confirm-container .confirm-content_btn {
    margin-top: 84px;
    gap: 15px;
  }
}
.product-confirm .shopping-confirm-container .confirm-content_btn .btn_back,
.product-confirm .shopping-confirm-container .confirm-content_btn .btn_submit {
  color: #FFF;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  font-size: 20px;
  letter-spacing: 2px;
  cursor: pointer;
  border-radius: 5px;
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
  border: none;
  margin: 0;
}
@media screen and (min-width: 768px) {
  .product-confirm .shopping-confirm-container .confirm-content_btn .btn_back,
  .product-confirm .shopping-confirm-container .confirm-content_btn .btn_submit {
    height: 70px;
  }
}
@media screen and (max-width: 767px) {
  .product-confirm .shopping-confirm-container .confirm-content_btn .btn_back,
  .product-confirm .shopping-confirm-container .confirm-content_btn .btn_submit {
    height: 58px;
  }
}
.product-confirm .shopping-confirm-container .confirm-content_btn .btn_back {
  background: #D1D1D1;
}
@media screen and (min-width: 768px) {
  .product-confirm .shopping-confirm-container .confirm-content_btn .btn_back {
    width: max(34.5714285714%, 242px);
  }
}
@media screen and (max-width: 767px) {
  .product-confirm .shopping-confirm-container .confirm-content_btn .btn_back {
    font-size: 13px;
    width: max(43.4285714286%, 152px);
  }
}
.product-confirm .shopping-confirm-container .confirm-content_btn .btn_submit {
  background: #57C6EA;
}
@media screen and (min-width: 768px) {
  .product-confirm .shopping-confirm-container .confirm-content_btn .btn_submit {
    width: 61%;
  }
}
@media screen and (max-width: 767px) {
  .product-confirm .shopping-confirm-container .confirm-content_btn .btn_submit {
    width: 52.2857142857%;
  }
}

/* -----------------------
  login
----------------------- */
.login-container {
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  gap: 100px;
}
@media screen and (min-width: 768px) {
  .login-container {
    max-width: 700px;
    margin-top: 100px;
  }
}
@media screen and (max-width: 767px) {
  .login-container {
    padding-inline: 20px;
    margin-top: 60px;
  }
}
.login-container .login-content .content_title {
  padding-bottom: 10px;
  border-bottom: dashed 3px #A9DAEA;
}
.login-container .login-content .content_title .TL {
  color: #585D5F;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  font-size: 20px;
  letter-spacing: 2px;
}
@media screen and (min-width: 768px) {
  .login-container .login-content .content_text {
    margin: 10px 0 30px;
  }
}
@media screen and (max-width: 767px) {
  .login-container .login-content .content_text {
    margin: 20px 0 30px;
  }
}
.login-container .login-content .content_text .TX {
  color: #989898;
  font-weight: 500;
  line-height: 1.5;
  font-size: 16px;
  letter-spacing: 1px;
}
.login-container .login-content .content_block {
  border-radius: 10px;
  background: #F3F9FB;
}
@media screen and (min-width: 768px) {
  .login-container .login-content .content_block {
    padding: 27px 51px 32px;
  }
}
@media screen and (max-width: 767px) {
  .login-container .login-content .content_block {
    padding: 43px 32px 60px;
  }
}
@media screen and (min-width: 768px) {
  .login-container .login-content .content_block.new_block {
    padding: 53px 0 55px;
  }
}
@media screen and (max-width: 767px) {
  .login-container .login-content .content_block.new_block {
    padding: 46px 32px 191px;
  }
}
.login-container .login-content .content_block .log-in-inputs {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
@media screen and (min-width: 768px) {
  .login-container .login-content .content_block .log-in-inputs {
    margin-bottom: 30px;
  }
}
@media screen and (max-width: 767px) {
  .login-container .login-content .content_block .log-in-inputs {
    margin-bottom: 30px;
  }
}
.login-container .login-content .content_block .log-in-inputs li .TX {
  color: #989898;
  font-size: 15px;
  font-weight: 500;
  line-height: 1.5;
  letter-spacing: 1.3px;
}
.login-container .login-content .content_block .log-in-inputs li input {
  width: 100%;
  height: 46px;
  background: #FFF;
  border: unset;
}
.login-container .login-content .content_block .jump_btn {
  border-radius: 100px;
  background: #A8DAE9;
  color: #FFF;
  text-align: center;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  display: block;
  padding: 16px 0;
  letter-spacing: 2.4px;
  font-size: 20px;
  border: unset;
  height: unset;
  margin: 0 auto;
}
@media screen and (min-width: 768px) {
  .login-container .login-content .content_block .jump_btn {
    width: 283px;
  }
}
@media screen and (max-width: 767px) {
  .login-container .login-content .content_block .jump_btn {
    width: 100%;
  }
}
.login-container .login-content .content_block .jump_btn:hover {
  background: #57C6EA;
}
.login-container .login-content .content_block .text {
  margin-top: 28px;
}
.login-container .login-content .content_block .text .TX {
  color: #585D5F;
  font-weight: 500;
  line-height: 1.5;
  font-size: 12px;
  letter-spacing: 1.2px;
}
@media screen and (min-width: 768px) {
  .login-container .login-content .content_block .text .TX {
    text-align: center;
  }
}
.login-container .login-content .content_block .pass-end {
  display: flex;
  flex-direction: column;
  gap: 25px;
  color: #57C6EA;
  font-size: 12px;
  font-weight: 500;
  line-height: 1.5;
  letter-spacing: 1.2px;
  text-decoration-line: underline;
  display: block;
  width: fit-content;
  margin: 20px auto 0;
}
@media screen and (max-width: 767px) {
  .login-container .login-content .content_block .pass-end {
    margin-inline: unset;
  }
}

/* -----------------------
  signup
----------------------- */
@media screen and (min-width: 768px) {
  .signup-container {
    display: flex;
    flex-direction: column;
    gap: 160px;
  }
}
@media screen and (max-width: 767px) {
  .signup-container {
    display: flex;
    flex-direction: column;
    gap: 100px;
  }
}
.signup-container .rule-container {
  margin: 0 auto;
}
@media screen and (min-width: 768px) {
  .signup-container .rule-container {
    margin-top: 100px;
    max-width: 700px;
  }
}
@media screen and (max-width: 767px) {
  .signup-container .rule-container {
    margin-top: 60px;
    padding: 0 20px;
  }
}
.signup-container .rule-container_title {
  padding-bottom: 10px;
  border-bottom: dashed 3px #A9DAEA;
}
.signup-container .rule-container_title .TL {
  color: #989898;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  letter-spacing: 1.6px;
  font-size: 16px;
}
.signup-container .rule-container_text {
  margin-top: 10px;
}
.signup-container .rule-container_text .TX {
  color: #989898;
  font-weight: 500;
  line-height: 1.5;
  letter-spacing: 1.3px;
  font-size: 13px;
}
.signup-container .rule-container_main {
  padding: 15px 23px;
  overflow-y: scroll;
  border-radius: 5px;
  background: #F2F2F2;
  box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1) inset;
  width: 100%;
  height: 200px;
}
@media screen and (min-width: 768px) {
  .signup-container .rule-container_main {
    margin-top: 60px;
  }
}
@media screen and (max-width: 767px) {
  .signup-container .rule-container_main {
    margin-top: 30px;
    padding-inline: 11px;
  }
}
.signup-container .rule-container_main .TX {
  color: #989898;
  font-weight: 500;
  line-height: 180%;
  letter-spacing: 1px;
  font-size: 10px;
}
.signup-container .rule-container_btn {
  border-radius: 5px;
  border: 2px solid #EED06E;
  background: #FFF;
  cursor: pointer;
  transition: all 0.3s;
}
@media screen and (min-width: 768px) {
  .signup-container .rule-container_btn {
    padding: 18px 0 22px;
    margin-top: 40px;
  }
}
@media screen and (max-width: 767px) {
  .signup-container .rule-container_btn {
    padding: 21px 4px 22px 63px;
    margin-top: 30px;
  }
}
.signup-container .rule-container_btn:hover .TX:before {
  opacity: 1;
}
.signup-container .rule-container_btn.active {
  border: 2px #EED06E;
  background: #EED06E;
}
.signup-container .rule-container_btn.active .TX {
  color: #FFF;
}
.signup-container .rule-container_btn.active .TX:before {
  opacity: 1;
  background-image: url('data:image/svg+xml;utf-8,<svg xmlns="http://www.w3.org/2000/svg" width="54" height="36" viewBox="0 0 54 36" fill="none"><path d="M6 13.5385L19.641 30.0513C25.3846 22.6325 40 9.5 48 6" stroke="%23FFF" stroke-width="10.0513" stroke-linecap="round" stroke-linejoin="round"/></svg>');
}
.signup-container .rule-container_btn .TX {
  color: #EED06E;
  display: block;
  width: fit-content;
  margin: 0 auto;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  position: relative;
  transition: all 0.3s;
}
@media screen and (min-width: 768px) {
  .signup-container .rule-container_btn .TX {
    font-size: 20px;
    letter-spacing: 2px;
  }
}
@media screen and (max-width: 767px) {
  .signup-container .rule-container_btn .TX {
    font-size: 18px;
    letter-spacing: 1px;
  }
}
.signup-container .rule-container_btn .TX::before {
  content: "";
  position: absolute;
  top: 55%;
  translate: 0 -50%;
  width: 54px;
  height: 36px;
  background-image: url('data:image/svg+xml;utf-8,<svg xmlns="http://www.w3.org/2000/svg" width="54" height="36" viewBox="0 0 54 36" fill="none"><path d="M6 13.5385L19.641 30.0513C25.3846 22.6325 40 9.5 48 6" stroke="%23EED06E" stroke-width="10.0513" stroke-linecap="round" stroke-linejoin="round"/></svg>');
  background-size: contain;
  background-position: center;
  opacity: 0.2;
  transition: all 0.3s;
}
@media screen and (min-width: 768px) {
  .signup-container .rule-container_btn .TX::before {
    right: calc(100% + 20px);
  }
}
@media screen and (max-width: 767px) {
  .signup-container .rule-container_btn .TX::before {
    right: calc(100% + 10px);
  }
}
.signup-container .register-container {
  margin: 0 auto;
}
@media screen and (min-width: 768px) {
  .signup-container .register-container {
    margin-top: 80px;
  }
}
@media screen and (max-width: 767px) {
  .signup-container .register-container {
    margin-top: 60px;
  }
}
@media screen and (min-width: 768px) {
  .signup-container .register-container_text {
    margin: 10px 0 30px;
  }
}
@media screen and (max-width: 767px) {
  .signup-container .register-container_text {
    padding: 0 20px;
    margin: 0 0 30px;
  }
}
.signup-container .register-container_text .TX {
  color: #989898;
  font-weight: 500;
  line-height: 1.5;
  letter-spacing: 1.2px;
  font-size: 12px;
}
.signup-container .register-container_content {
  background: #F3F9FB;
  display: flex;
  flex-direction: column;
  gap: 60px;
}
@media screen and (min-width: 768px) {
  .signup-container .register-container_content {
    padding: 63px 94px 104px;
  }
}
@media screen and (max-width: 767px) {
  .signup-container .register-container_content {
    padding: 30px 20px 40px;
  }
}
.signup-container .register-container_content-item .item-title {
  padding-bottom: 3px;
  border-bottom: dashed 3px #A9DAEA;
}
.signup-container .register-container_content-item .item-title .TL {
  color: #989898;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  letter-spacing: 1.6px;
  font-size: 16px;
}
.signup-container .register-container_content-item .item-form {
  margin-top: 32px;
  padding-inline: 13px;
}
@media screen and (min-width: 768px) {
  .signup-container .register-container_content-item .item-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }
}
@media screen and (max-width: 767px) {
  .signup-container .register-container_content-item .item-form {
    display: flex;
    flex-direction: column;
    gap: 30px;
  }
}
.signup-container .register-container_content-item .item-form .form-cards input,
.signup-container .register-container_content-item .item-form .form-cards select {
  width: 100%;
  background: #FFF;
  border: none;
  appearance: none;
  height: 46px;
}
.signup-container .register-container_content-item .item-form .form-cards .form-cards-title {
  margin-bottom: 4px;
}
.signup-container .register-container_content-item .item-form .form-cards .form-cards-title .TX {
  color: #989898;
  font-weight: 500;
  line-height: 1.5;
  font-size: 13px;
}
@media screen and (min-width: 768px) {
  .signup-container .register-container_content-item .item-form .form-cards .form-cards-title .TX {
    letter-spacing: 1.3px;
  }
}
@media screen and (max-width: 767px) {
  .signup-container .register-container_content-item .item-form .form-cards .form-cards-title .TX {
    letter-spacing: 1px;
  }
}
.signup-container .register-container_content-item .item-form .form-cards .form-cards-inputs {
  display: flex;
}
@media screen and (min-width: 768px) {
  .signup-container .register-container_content-item .item-form .form-cards .form-cards-inputs {
    gap: 10px;
  }
}
@media screen and (max-width: 767px) {
  .signup-container .register-container_content-item .item-form .form-cards .form-cards-inputs {
    gap: 5px;
  }
}
.signup-container .register-container_content-item .item-form .form-cards .form-cards-inputs .inputs-block {
  width: 100%;
}
.signup-container .register-container_content-item .item-form .form-cards .form-cards-inputs.form-cards-inputs-sex {
  gap: 40px;
}
.signup-container .register-container_content-item .item-form .form-cards .form-cards-inputs.form-cards-inputs-sex .inputs-block {
  width: fit-content;
  display: flex;
  align-items: center;
  gap: 16px;
}
.signup-container .register-container_content-item .item-form .form-cards .form-cards-inputs.form-cards-inputs-sex .inputs-block input {
  flex-shrink: 0;
  border-radius: 50%;
  appearance: none;
  position: relative;
  width: 24px;
  height: 24px;
  flex-shrink: 0;
}
.signup-container .register-container_content-item .item-form .form-cards .form-cards-inputs.form-cards-inputs-sex .inputs-block input:checked::before {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  translate: -50% -50%;
  width: 60%;
  height: 60%;
  background: #A9DAEA;
  border-radius: 50%;
}
.signup-container .register-container_content-item .item-form .form-cards .form-cards-inputs.form-cards-inputs-sex .inputs-block label {
  color: #989898;
  font-weight: 500;
  line-height: 1.5;
  letter-spacing: 1.3px;
  font-size: 13px;
  white-space: nowrap;
}
@media screen and (min-width: 768px) {
  .signup-container .register-container_content-item .item-form .form-cards .form-cards-inputs.form-cards-inputs-birthdate {
    gap: 40px;
  }
}
@media screen and (max-width: 767px) {
  .signup-container .register-container_content-item .item-form .form-cards .form-cards-inputs.form-cards-inputs-birthdate {
    gap: 9px;
  }
}
.signup-container .register-container_content-item .item-form .form-cards .form-cards-inputs.form-cards-inputs-birthdate .inputs-block {
  width: fit-content;
  display: flex;
  align-items: center;
  gap: 3px;
}
.signup-container .register-container_content-item .item-form .form-cards .form-cards-inputs.form-cards-inputs-birthdate .inputs-block .select-wrap {
  position: relative;
}
.signup-container .register-container_content-item .item-form .form-cards .form-cards-inputs.form-cards-inputs-birthdate .inputs-block .select-wrap::before {
  content: "";
  display: block;
  width: 6px;
  height: 15px;
  background-image: url('data:image/svg+xml;utf-8,<svg width="6" height="15" viewBox="0 0 6 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 1.76L0.282 6.47H5.718L3 1.76Z" fill="%23989898"/><path d="M3 13.24L0.282 8.53H5.718L3 13.24Z" fill="%23989898"/></svg>');
  background-size: contain;
  background-position: center;
  background-repeat: no-repeat;
  position: absolute;
  top: 50%;
  translate: 0 -50%;
  right: 5px;
}
@media screen and (min-width: 768px) {
  .signup-container .register-container_content-item .item-form .form-cards .form-cards-inputs.form-cards-inputs-birthdate .inputs-block:nth-child(1) select {
    width: 115px;
  }
}
@media screen and (max-width: 767px) {
  .signup-container .register-container_content-item .item-form .form-cards .form-cards-inputs.form-cards-inputs-birthdate .inputs-block:nth-child(1) select {
    max-width: 115px;
    width: 29.4871794872vw;
  }
}
@media screen and (min-width: 768px) {
  .signup-container .register-container_content-item .item-form .form-cards .form-cards-inputs.form-cards-inputs-birthdate .inputs-block:nth-child(2) select, .signup-container .register-container_content-item .item-form .form-cards .form-cards-inputs.form-cards-inputs-birthdate .inputs-block:nth-child(3) select {
    width: 70px;
  }
}
@media screen and (max-width: 767px) {
  .signup-container .register-container_content-item .item-form .form-cards .form-cards-inputs.form-cards-inputs-birthdate .inputs-block:nth-child(2) select, .signup-container .register-container_content-item .item-form .form-cards .form-cards-inputs.form-cards-inputs-birthdate .inputs-block:nth-child(3) select {
    max-width: 70px;
    width: 17.9487179487vw;
  }
}
.signup-container .register-container_content-item .item-form .form-cards .form-cards-inputs.form-cards-inputs-birthdate .inputs-block .TX {
  color: #989898;
  font-weight: 500;
  line-height: 1.5;
  letter-spacing: 1.3px;
  font-size: 13px;
}
.signup-container .register-container_content-btn button {
  appearance: none;
  border: none;
  border-radius: 5px;
  background: #D1D1D1;
  margin: 0 auto;
  display: block;
  color: #FFF;
  text-align: center;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  height: 70px;
  pointer-events: none;
  cursor: default;
}
@media screen and (min-width: 768px) {
  .signup-container .register-container_content-btn button {
    font-size: 20px;
    letter-spacing: 2px;
    width: 450px;
  }
}
@media screen and (max-width: 767px) {
  .signup-container .register-container_content-btn button {
    font-size: 15px;
    letter-spacing: 1.5px;
    width: 225px;
    word-break: keep-all;
  }
}
.signup-container .register-container_content-btn button.all-ok {
  cursor: pointer;
  background: #57C6EA;
  pointer-events: auto;
}

/* -----------------------
  signup-confirm
----------------------- */
@media screen and (max-width: 767px) {
  .signup-confirm-container {
    padding-inline: 20px;
  }
}
.signup-confirm-container .signup-confirm-content {
  margin: 0 auto;
}
@media screen and (min-width: 768px) {
  .signup-confirm-container .signup-confirm-content {
    margin-top: 80px;
    max-width: 700px;
  }
}
@media screen and (max-width: 767px) {
  .signup-confirm-container .signup-confirm-content {
    margin-top: 60px;
  }
}
.signup-confirm-container .signup-confirm-content-text {
  margin-bottom: 30px;
}
.signup-confirm-container .signup-confirm-content-text .TX {
  color: #989898;
  font-weight: 500;
  line-height: 1.5;
  letter-spacing: 1.2px;
  font-size: 12px;
}
@media screen and (min-width: 768px) {
  .signup-confirm-container .signup-confirm-content .signup-confirm-form {
    display: flex;
    flex-direction: column;
    gap: 30px;
  }
}
@media screen and (max-width: 767px) {
  .signup-confirm-container .signup-confirm-content .signup-confirm-form {
    display: flex;
    flex-direction: column;
    gap: 60px;
  }
}
.signup-confirm-container .signup-confirm-content .signup-confirm-form .form_content .form_content-title {
  margin-bottom: 14px;
}
.signup-confirm-container .signup-confirm-content .signup-confirm-form .form_content .form_content-title .TL {
  color: #989898;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  letter-spacing: 1.6px;
  font-size: 16px;
}
.signup-confirm-container .signup-confirm-content .signup-confirm-form .form_content .form_content-main {
  display: flex;
  flex-direction: column;
  gap: 1px;
}
.signup-confirm-container .signup-confirm-content .signup-confirm-form .form_content .form_content-main .main_item {
  display: flex;
  gap: 1px;
}
@media screen and (min-width: 768px) {
  .signup-confirm-container .signup-confirm-content .signup-confirm-form .form_content .form_content-main .main_item {
    min-height: 70px;
  }
}
@media screen and (max-width: 767px) {
  .signup-confirm-container .signup-confirm-content .signup-confirm-form .form_content .form_content-main .main_item {
    min-height: 58px;
  }
}
.signup-confirm-container .signup-confirm-content .signup-confirm-form .form_content .form_content-main .main_item-title {
  background: #A8DAE9;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-shrink: 0;
  padding: 5px;
}
@media screen and (min-width: 768px) {
  .signup-confirm-container .signup-confirm-content .signup-confirm-form .form_content .form_content-main .main_item-title {
    width: 147px;
  }
}
@media screen and (max-width: 767px) {
  .signup-confirm-container .signup-confirm-content .signup-confirm-form .form_content .form_content-main .main_item-title {
    width: 122px;
  }
}
.signup-confirm-container .signup-confirm-content .signup-confirm-form .form_content .form_content-main .main_item-title .TL {
  color: #FFF;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  font-size: 15px;
}
.signup-confirm-container .signup-confirm-content .signup-confirm-form .form_content .form_content-main .main_item-text {
  background: #F3F9FB;
  display: flex;
  flex-direction: column;
  justify-content: center;
  width: 100%;
  padding: 5px 38px;
}
@media screen and (max-width: 767px) {
  .signup-confirm-container .signup-confirm-content .signup-confirm-form .form_content .form_content-main .main_item-text {
    padding-inline: 15px;
  }
}
.signup-confirm-container .signup-confirm-content .signup-confirm-form .form_content .form_content-main .main_item-text .TX {
  color: #585D5F;
  font-weight: 500;
  line-height: 1.5;
  font-size: 15px;
}
.signup-confirm-container .signup-confirm-content .confirm-content_btn {
  display: flex;
}
@media screen and (min-width: 768px) {
  .signup-confirm-container .signup-confirm-content .confirm-content_btn {
    margin-top: 100px;
    gap: 23px;
  }
}
@media screen and (max-width: 767px) {
  .signup-confirm-container .signup-confirm-content .confirm-content_btn {
    margin-top: 84px;
    gap: 15px;
  }
}
.signup-confirm-container .signup-confirm-content .confirm-content_btn .btn_back,
.signup-confirm-container .signup-confirm-content .confirm-content_btn .btn_submit {
  color: #FFF;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  font-size: 20px;
  letter-spacing: 2px;
  cursor: pointer;
  border-radius: 5px;
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
  border: none;
  margin: 0;
}
@media screen and (min-width: 768px) {
  .signup-confirm-container .signup-confirm-content .confirm-content_btn .btn_back,
  .signup-confirm-container .signup-confirm-content .confirm-content_btn .btn_submit {
    height: 70px;
  }
}
@media screen and (max-width: 767px) {
  .signup-confirm-container .signup-confirm-content .confirm-content_btn .btn_back,
  .signup-confirm-container .signup-confirm-content .confirm-content_btn .btn_submit {
    height: 58px;
  }
}
.signup-confirm-container .signup-confirm-content .confirm-content_btn .btn_back {
  background: #D1D1D1;
}
@media screen and (min-width: 768px) {
  .signup-confirm-container .signup-confirm-content .confirm-content_btn .btn_back {
    width: max(34.5714285714%, 242px);
  }
}
@media screen and (max-width: 767px) {
  .signup-confirm-container .signup-confirm-content .confirm-content_btn .btn_back {
    font-size: 13px;
    width: max(43.4285714286%, 152px);
  }
}
.signup-confirm-container .signup-confirm-content .confirm-content_btn .btn_submit {
  background: #57C6EA;
}
@media screen and (min-width: 768px) {
  .signup-confirm-container .signup-confirm-content .confirm-content_btn .btn_submit {
    width: 61%;
  }
}
@media screen and (max-width: 767px) {
  .signup-confirm-container .signup-confirm-content .confirm-content_btn .btn_submit {
    width: 52.2857142857%;
  }
}

/* -----------------------
  signup-complete
----------------------- */
.signup-complete-container .C_TL .TL.color {
  color: #57C6EA;
}
@media screen and (min-width: 768px) {
  .signup-complete-container .signup-complete-content {
    margin-top: 80px;
    display: flex;
    flex-direction: column;
    gap: 65px;
  }
}
@media screen and (max-width: 767px) {
  .signup-complete-container .signup-complete-content {
    margin-top: 60px;
    display: flex;
    flex-direction: column;
    gap: 60px;
    padding: 0 20px;
  }
}
.signup-complete-container .signup-complete-content .complete_text {
  margin: 0 auto;
}
@media screen and (min-width: 768px) {
  .signup-complete-container .signup-complete-content .complete_text {
    width: 500px;
  }
}
.signup-complete-container .signup-complete-content .complete_text.complete_text_contact {
  display: flex;
  flex-direction: column;
  gap: 30px;
}
@media screen and (min-width: 768px) {
  .signup-complete-container .signup-complete-content .complete_text.complete_text_contact {
    width: 720px;
  }
}
.signup-complete-container .signup-complete-content .complete_text .TX {
  color: #989898;
  text-align: center;
  font-weight: 500;
  letter-spacing: 1.5px;
  font-size: 15px;
}
@media screen and (min-width: 768px) {
  .signup-complete-container .signup-complete-content .complete_text .TX {
    line-height: 1.5;
  }
}
@media screen and (max-width: 767px) {
  .signup-complete-container .signup-complete-content .complete_text .TX {
    line-height: 2.1;
  }
}
.signup-complete-container .signup-complete-content .complete_text .TX a {
  color: #57C6EA;
  font-size: 15px;
  font-weight: 500;
  line-height: 30px;
  letter-spacing: 1.5px;
  text-decoration-line: underline;
}
.signup-complete-container .signup-complete-content .complete_btn {
  border-radius: 100px;
  background: #A8DAE9;
  display: block;
  margin: 0 auto;
  width: 284px;
  padding: 16px 0;
}
.signup-complete-container .signup-complete-content .complete_btn .TX {
  color: #FFF;
  text-align: center;
  font-size: 20px;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  letter-spacing: 2.4px;
}

/* -----------------------
  contact
----------------------- */
@media screen and (min-width: 768px) {
  .contact-container .contact-content {
    margin-top: 100px;
  }
}
@media screen and (max-width: 767px) {
  .contact-container .contact-content {
    margin-top: 60px;
  }
}
@media screen and (min-width: 768px) {
  .contact-container .contact-content_inner {
    display: flex;
    flex-direction: column;
    gap: 100px;
  }
}
@media screen and (max-width: 767px) {
  .contact-container .contact-content_inner {
    display: flex;
    flex-direction: column;
    gap: 30px;
    background: #F3F9FB;
    padding: 35px 30px 33px;
  }
}
@media screen and (min-width: 768px) {
  .contact-container .contact-content_inner .contact_main {
    background: #F3F9FB;
    padding: 71px 107px 101px;
    display: flex;
    flex-direction: column;
    gap: 15px;
  }
}
@media screen and (max-width: 767px) {
  .contact-container .contact-content_inner .contact_main {
    display: flex;
    flex-direction: column;
    gap: 30px;
  }
}
.contact-container .contact-content_inner .contact_main .contact_main_items .item_title {
  margin-bottom: 4px;
}
.contact-container .contact-content_inner .contact_main .contact_main_items .item_title .TX {
  color: #989898;
  font-weight: 500;
  line-height: 1.5;
  letter-spacing: 1.3px;
  font-size: 13px;
}
@media screen and (max-width: 767px) {
  .contact-container .contact-content_inner .contact_main .contact_main_items .item_title .TX span {
    font-size: 10px;
    letter-spacing: 1px;
  }
}
.contact-container .contact-content_inner .contact_main .contact_main_items .item_input {
  display: flex;
}
@media screen and (min-width: 768px) {
  .contact-container .contact-content_inner .contact_main .contact_main_items .item_input {
    gap: 21px;
  }
}
@media screen and (max-width: 767px) {
  .contact-container .contact-content_inner .contact_main .contact_main_items .item_input {
    gap: 10px;
  }
}
.contact-container .contact-content_inner .contact_main .contact_main_items .item_input .input_block {
  width: 100%;
}
.contact-container .contact-content_inner .contact_main .contact_main_items .item_input .input_block .input {
  width: 100%;
  display: block;
  border: none;
  appearance: none;
  resize: none;
  height: 46px;
}
.contact-container .contact-content_inner .contact_main .contact_main_items .item_input .input_block .input.textarea {
  height: 200px;
}
.contact-container .contact-content_inner .contact_main .contact_main_items .item_input .input_block .select-wrap {
  position: relative;
}
.contact-container .contact-content_inner .contact_main .contact_main_items .item_input .input_block .select-wrap::before {
  content: "";
  display: block;
  width: 6px;
  height: 15px;
  background-image: url('data:image/svg+xml;utf-8,<svg width="6" height="15" viewBox="0 0 6 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 1.76L0.282 6.47H5.718L3 1.76Z" fill="%23989898"/><path d="M3 13.24L0.282 8.53H5.718L3 13.24Z" fill="%23989898"/></svg>');
  background-size: contain;
  background-position: center;
  background-repeat: no-repeat;
  position: absolute;
  top: 50%;
  translate: 0 -50%;
  right: 5px;
}
.contact-container .contact-content_inner .contact_btn input {
  border-radius: 5px;
  background: #57C6EA;
  border: none;
  margin: 0 auto;
  display: block;
  color: #FFF;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
}
@media screen and (min-width: 768px) {
  .contact-container .contact-content_inner .contact_btn input {
    width: 427px;
    padding-block: 16px;
    letter-spacing: 2.5px;
    font-size: 25px;
  }
}
@media screen and (max-width: 767px) {
  .contact-container .contact-content_inner .contact_btn input {
    width: 183px;
    padding-block: 17px 18px;
    font-size: 15px;
    letter-spacing: 1.5px;
  }
}
@media screen and (min-width: 768px) {
  .contact-container .contact-content .contact-confirm-content_inner {
    padding-inline: 60px;
  }
}
@media screen and (max-width: 767px) {
  .contact-container .contact-content .contact-confirm-content_inner {
    padding-inline: 20px;
  }
}
.contact-container .contact-content .contact-confirm-content_inner .contact-confirm-text {
  margin-bottom: 30px;
}
.contact-container .contact-content .contact-confirm-content_inner .contact-confirm-text .TX {
  color: #989898;
  font-weight: 500;
  line-height: 1.5;
  letter-spacing: 1.2px;
  font-size: 12px;
}
@media screen and (min-width: 768px) {
  .contact-container .contact-content .contact-confirm-content_inner .contact-confirm-form {
    display: flex;
    flex-direction: column;
    gap: 30px;
  }
}
@media screen and (max-width: 767px) {
  .contact-container .contact-content .contact-confirm-content_inner .contact-confirm-form {
    display: flex;
    flex-direction: column;
    gap: 60px;
  }
}
.contact-container .contact-content .contact-confirm-content_inner .contact-confirm-form .form_content .form_content-main {
  display: flex;
  flex-direction: column;
  gap: 1px;
}
.contact-container .contact-content .contact-confirm-content_inner .contact-confirm-form .form_content .form_content-main .main_item {
  display: flex;
  gap: 1px;
}
@media screen and (min-width: 768px) {
  .contact-container .contact-content .contact-confirm-content_inner .contact-confirm-form .form_content .form_content-main .main_item {
    min-height: 70px;
  }
}
@media screen and (max-width: 767px) {
  .contact-container .contact-content .contact-confirm-content_inner .contact-confirm-form .form_content .form_content-main .main_item {
    min-height: 58px;
  }
}
.contact-container .contact-content .contact-confirm-content_inner .contact-confirm-form .form_content .form_content-main .main_item-title {
  background: #A8DAE9;
  flex-shrink: 0;
  padding: 5px;
}
@media screen and (min-width: 768px) {
  .contact-container .contact-content .contact-confirm-content_inner .contact-confirm-form .form_content .form_content-main .main_item-title {
    width: 147px;
    padding-top: 25px;
  }
}
@media screen and (max-width: 767px) {
  .contact-container .contact-content .contact-confirm-content_inner .contact-confirm-form .form_content .form_content-main .main_item-title {
    width: 111px;
    padding-top: 20px;
  }
}
.contact-container .contact-content .contact-confirm-content_inner .contact-confirm-form .form_content .form_content-main .main_item-title .TL {
  color: #FFF;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  text-align: center;
}
@media screen and (min-width: 768px) {
  .contact-container .contact-content .contact-confirm-content_inner .contact-confirm-form .form_content .form_content-main .main_item-title .TL {
    line-height: 1.5;
    font-size: 15px;
  }
}
@media screen and (max-width: 767px) {
  .contact-container .contact-content .contact-confirm-content_inner .contact-confirm-form .form_content .form_content-main .main_item-title .TL {
    line-height: 1;
    font-size: 12px;
  }
}
.contact-container .contact-content .contact-confirm-content_inner .contact-confirm-form .form_content .form_content-main .main_item-text {
  background: #F3F9FB;
  display: flex;
  flex-direction: column;
  justify-content: center;
  width: 100%;
  padding: 5px 38px;
}
@media screen and (max-width: 767px) {
  .contact-container .contact-content .contact-confirm-content_inner .contact-confirm-form .form_content .form_content-main .main_item-text {
    padding-inline: 15px;
  }
}
.contact-container .contact-content .contact-confirm-content_inner .contact-confirm-form .form_content .form_content-main .main_item-text .TX {
  color: #585D5F;
  font-weight: 500;
  line-height: 1.5;
  font-size: 15px;
}
.contact-container .contact-content .contact-confirm-content_inner .confirm-content_btn {
  display: flex;
  justify-content: center;
}
@media screen and (min-width: 768px) {
  .contact-container .contact-content .contact-confirm-content_inner .confirm-content_btn {
    margin-top: 50px;
    gap: 23px;
  }
}
@media screen and (max-width: 767px) {
  .contact-container .contact-content .contact-confirm-content_inner .confirm-content_btn {
    margin-top: 60px;
    gap: 15px;
  }
}
.contact-container .contact-content .contact-confirm-content_inner .confirm-content_btn .btn_back,
.contact-container .contact-content .contact-confirm-content_inner .confirm-content_btn .btn_submit {
  color: #FFF;
  font-weight: 700;
  text-shadow: 0 0 0.5px;
  line-height: 1.5;
  font-size: 20px;
  letter-spacing: 2px;
  cursor: pointer;
  border-radius: 5px;
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
  border: none;
  margin: 0;
}
@media screen and (min-width: 768px) {
  .contact-container .contact-content .contact-confirm-content_inner .confirm-content_btn .btn_back,
  .contact-container .contact-content .contact-confirm-content_inner .confirm-content_btn .btn_submit {
    height: 70px;
  }
}
@media screen and (max-width: 767px) {
  .contact-container .contact-content .contact-confirm-content_inner .confirm-content_btn .btn_back,
  .contact-container .contact-content .contact-confirm-content_inner .confirm-content_btn .btn_submit {
    height: 58px;
  }
}
.contact-container .contact-content .contact-confirm-content_inner .confirm-content_btn .btn_back {
  background: #D1D1D1;
}
@media screen and (min-width: 768px) {
  .contact-container .contact-content .contact-confirm-content_inner .confirm-content_btn .btn_back {
    width: max(34.5714285714%, 242px);
  }
}
@media screen and (max-width: 767px) {
  .contact-container .contact-content .contact-confirm-content_inner .confirm-content_btn .btn_back {
    font-size: 13px;
    width: max(43.4285714286%, 152px);
  }
}
.contact-container .contact-content .contact-confirm-content_inner .confirm-content_btn .btn_submit {
  background: #57C6EA;
}
@media screen and (min-width: 768px) {
  .contact-container .contact-content .contact-confirm-content_inner .confirm-content_btn .btn_submit {
    width: 61%;
  }
}
@media screen and (max-width: 767px) {
  .contact-container .contact-content .contact-confirm-content_inner .confirm-content_btn .btn_submit {
    width: 52.2857142857%;
  }
}

/* -----------------------
  card-custom
----------------------- */
.product-form .paymentDescription select,
.product-form .paymentDescription input {
  border: 1px solid #ccc !important;
  margin-top: 10px;
}
.product-form .paymentDescription .efoBox {
  gap: 10px;
}
.product-form .paymentDescription .selectWrap {
  position: relative;
  width: 100px;
}
.product-form .paymentDescription .m-small {
  position: relative;
}
@media screen and (min-width: 768px) {
  .product-form .paymentDescription .m-small {
    top: 33px;
  }
}
@media screen and (max-width: 767px) {
  .product-form .paymentDescription .m-small {
    top: 11px;
  }
}
.product-form .paymentDescription .m-small::after {
  content: "?";
  font-size: 13px;
  width: 23px;
  height: 23px;
  border: 1px solid #989898;
  border-radius: 50%;
  display: grid;
  place-items: center center;
  position: absolute;
  top: 50%;
  translate: 0 -50%;
  left: -28px;
}

/* -----------------------
    billing
----------------------- */
.product-form .shopping-form-container .form_container .form_content form .form_content-item .billing-check {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  position: relative;
}
@media screen and (min-width: 768px) {
  .product-form .shopping-form-container .form_container .form_content form .form_content-item .billing-check {
    width: 20px;
    height: 20px;
  }
}
@media screen and (max-width: 767px) {
  .product-form .shopping-form-container .form_container .form_content form .form_content-item .billing-check {
    width: 20px;
    height: 20px;
  }
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .billing-check:checked::before {
  content: "";
  width: 80%;
  height: 30%;
  background: unset;
  border-radius: 0;
  border-bottom: solid 2px #A8DAE9;
  border-left: solid 2px #A8DAE9;
  position: absolute;
  top: 30%;
  left: 50%;
  transform: translate(-50%, -50%) rotate(-45deg);
}
.product-form .shopping-form-container .form_container .form_content form .form_content-item .check-TX {
  color: #989898;
  font-size: 14px;
  font-weight: 500;
  letter-spacing: 1px;
  margin-top: -15px;
}

.billing-input.input-area {
  display: none !important;
}

#new_add_flag:checked ~ .billing-input {
  display: flex !important;
}

/*# sourceMappingURL=main.css.map */
