<template>
    <li class="article-item">
        <div class="article-title">
            <b-row>
                <b-col cols="9">
                    <router-link :to="'/blog/' + item.id" ><h3>初识 wepy (微信小程序开发框架)</h3></router-link>
                </b-col>
                <b-col clos="3">
                    <time class="article-time">
                        <span class="article-time-day">17</span>
                        <span class="article-time-month">09</span>
                        <span class="article-time-year">2018</span>
                    </time>
                </b-col>
            </b-row>
            <b-row class="article-auther">
                <ul>
                    <li>
                        <span class="iconfont ">&#xe673;</span> Itzcy
                    </li>
                    <li>
                        <span class="iconfont ">&#xe627;</span> 1216431
                    </li>
                </ul>
            </b-row>
        </div>

        <div class="article-body">
            <figure class="article-img col-sm-12 col-md-5 img-flicker">
                <router-link :to="'/blog/' + item.id" >
                    <div class="master-img image" style="background-image:url(./static/image/default.jpg)"></div>
                </router-link>
            </figure>

            <section class="article-text ">
                运行wepy 需要的环境   首先需要能运行 npm , 运行npm 的前提就是安装好nodejs, 安装好nodejs 后...运行wepy 需要的环境   首先需要能运行 npm , 运行npm 的前提就是安装好nodejs, 安装好nodejs 后...运行wepy 需要的环境   首先需要能运行 npm , 运行npm 的前提就是安装好nodejs, 安装好nodejs 后...运行wepy 需要的环境   首先需要能运行 npm , 运行npm 的前提就是安装好nodejs, 安装好nodejs 后...运行wepy 需要的环境   首先需要能运行 npm , 运行npm 的前提就是安装好nodejs, 安装好nodejs 后...运行wepy 需要的环境   首先需要能运行 npm , 运行npm 的前提就是安装好nodejs, 安装好nodejs 后...运行wepy 需要的环境   首先需要能运行 npm , 运行npm 的前提就是安装好nodejs, 安装好nodejs 后...运行wepy 需要的环境   首先需要能运行 npm , 运行npm 的前提就是安装好nodejs, 安装好nodejs 后...运行wepy 需要的环境   首先需要能运行 npm , 运行npm 的前提就是安装好nodejs, 安装好nodejs 后...运行wepy 需要的环境   首先需要能运行 npm , 运行npm 的前提就是安装好nodejs, 安装好nodejs 后...运行wepy 需要的环境   首先需要能运行 npm ,
            </section>
        </div>

    </li>
</template>

<script>
export default {
    props: ['item'],
    created () {
    }
}
</script>

<style lang="less" scoped>

/* 文章块 */
.article-item {
    display: block;
    overflow: hidden;
    background: #ffffff;
    padding: 0.666rem 1.2366rem;
}
/* 文章标题 */
.article-title {
    position:relative;
    overflow:hidden;
    /* margin-bottom: 1rem; */
    padding-top:1rem;
    padding-bottom: 0.333rem;
    width: 100%;
    border-bottom: 1px solid #eeeeee;
    & h3{
        font-size: 1.5rem;
    }
}
.article-auther{
    padding:0.333rem 1rem;
    color:#666666;
    & li{
        margin: 0 0.8rem 0 0;
    }
}
/* 文章标题滑动线 */
.article-title:after {
    position: absolute;
    bottom: 0px;
    left: -1px;
    width: 0;
    height: 2px;
    background-color: #f76a0c;
    content: "";
    transition: width .2s;
}
.article-list .article-item:hover .article-title:after {
    width: 100%;
}
.article-time{
    position: absolute;
    right:1rem;
    top:0rem;
    & .article-time-day{
        position: absolute;
        left:-160%;
        top:-26%;
        font-size:3rem;
        color: #f76a0c;
    }
    & .article-time-month,.article-time-year{
        text-transform: uppercase;
        display: block;
        color:#b6bdcf;
    }
}

/* 文章内容区 */
.article-list .article-item .article-body{
    overflow: hidden;
    padding: 1rem 0;
}
/* 文章大图 */
.article-img {
    padding: 0;
}
@media (min-width: 992px){
    .article-list .article-item .article-body .article-img{
        float:left;
        margin: 0 1rem 1rem 0;
    }
}
.article-list .article-item .article-body .article-img .image{
    position: relative;
    overflow: hidden;
    padding-top: 58.88%;
    width: 100%;
    background-color: #eeeeee;
    background-size: cover;
    background-repeat: no-repeat;
}
/* 文章部分文字 */
.article-list .article-item .article-body .article-text {
    font-size: 0.833rem;
    margin-top:-0.3rem;
    word-spacing: 0.003rem;
    letter-spacing: 0.065rem;
    line-height: 1.7rem;
    // text-indent: 2rem;
    color: #525251;
}
</style>
