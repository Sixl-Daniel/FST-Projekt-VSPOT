<style>
html {
    font-family: 'Nunito', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    -webkit-text-size-adjust: none;
    -webkit-font-smoothing: antialiased;
    font-size: 16px;
    font-variant-ligatures: common-ligatures;
}

@media screen and (min-width: 320px) {
    html {
        font-size: calc(16px + 112 * ((100vw - 320px) / 3280));
    }
}

@media screen and (min-width: 3600px) {
    html {
        font-size: 128px;
    }
}

html, body {
    position: relative;
    height: 100%;
}

body {
    margin: 0;
    padding: 0;
    background: #000000;
    color: #000000;
}

p {
    line-height: 1.5rem;
    margin-top: 1.5rem;
    margin-bottom: 0;
}

ul,
ol {
    margin-top: 1.5rem;
    margin-bottom: 1.5rem;
}

ul li,
ol li {
    line-height: 1.5rem;
}

ul ul,
ol ul,
ul ol,
ol ol {
    margin-top: 0;
    margin-bottom: 0;
}

blockquote {
    line-height: 1.5rem;
    margin-top: 1.5rem;
    margin-bottom: 1.5rem;
}

h1, .h1,
h2, .h2,
h3, .h3,
h4, .h4,
h5, .h5,
h6, .h6 {
    margin-top: 1.5rem;
    margin-bottom: 0;
    line-height: 1.5rem;
}

h1, .h1 {
    font-size: 4.242rem;
    line-height: 4.5rem;
    margin-top: 3rem;
}

h2, .h2 {
    font-size: 2.828rem;
    line-height: 3rem;
    margin-top: 3rem;
}

h3, .h3 {
    font-size: 1.414rem;
}

h4, .h4 {
    font-size: 0.707rem;
}

h5, .h5 {
    font-size: 0.4713333333333333rem;
}

h6, .h6 {
    font-size: 0.3535rem;
}

.lead {
    font-size: 1.414rem;
}

.bold {
    font-weight: 700;
}

.text-left {
    text-align: left;
}

.text-right {
    text-align: right;
}

.mt-0 {
    margin-top: 0;
}

.mb-0 {
    margin-bottom: 0;
}

.my-0 {
    margin-top: 0;
    margin-bottom: 0;
}

.heading {
    font-language-override: normal;
    font-kerning: auto;
    font-feature-settings: 'kern', 'liga', 'dlig', 'hlig', 'cswh';
    font-synthesis: weight style;
}

.heading--main {
    font-weight: 200;
    margin: 0;
}

.heading--sub {
    font-weight: 600;
    margin: 0;
}

.swiper-container {
    overflow: hidden;
    z-index: 1;
    opacity: 1;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    width: 100%;
    height: 100%;
    margin-left: auto;
    margin-right: auto;
}

.swiper-slide {
    text-align: center;
    color: #FEFEFE;
    display: flex;
    flex-flow: column wrap;
    justify-content: center;
    align-items: center;
    background-size: cover;
    background-color: #000000;
    background-position: center;
}

.swiper-slide .overlay {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: -1;
}

.swiper-pagination-bullet {
    background: #000;
    opacity: .3;
    border: 2px solid white;
}

.swiper-pagination-bullet-active {
    opacity: 1;
    background: #000;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.fadeIn {
    animation: fadeIn 900ms ease-out;
}
</style>
