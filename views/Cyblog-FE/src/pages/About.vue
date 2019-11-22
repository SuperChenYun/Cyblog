<template>
    <div class="about">
        <view-menu/>
        <b-container fluid class="top-title">
            <div class="top-img"></div>
            <div class="top-text">
                <h2>About</h2>
                <p>--------------------------</p>
            </div>
        </b-container>
        <b-container class="">
            <div class="resume">
                <h3>张辰云</h3>
                <div>
                    <div>不想写代码的程序员</div>
                    <p>
                        PHP,Linux,Vue,Docker,Redis,MariaDB
                    </p>
                </div>
                <h4>release</h4>
                <ul class="release">
                    <li>本站程序是基于 ThinkPHP 和 Vue 来搭建的，前端使用Vue 后端使用ThinkPHP 提供数据接口</li>
                    <li>本站程序是基于 ThinkPHP 和 Vue 来搭建的，前端使用Vue 后端使用ThinkPHP 提供数据接口</li>
                    <li>本站程序是基于 ThinkPHP 和 Vue 来搭建的，前端使用Vue 后端使用ThinkPHP 提供数据接口</li>
                    <li>本站程序是基于 ThinkPHP 和 Vue 来搭建的，前端使用Vue 后端使用ThinkPHP 提供数据接口</li>
                    <li>本站程序是基于 ThinkPHP 和 Vue 来搭建的，前端使用Vue 后端使用ThinkPHP 提供数据接口</li>
                    <li>本站程序是基于 ThinkPHP 和 Vue 来搭建的，前端使用Vue 后端使用ThinkPHP 提供数据接口</li>
                    <li>本站程序是基于 ThinkPHP 和 Vue 来搭建的，前端使用Vue 后端使用ThinkPHP 提供数据接口</li>
                </ul>
            </div>
        </b-container>
        <view-footer/>
    </div>
</template>

<script>
import Menu from '../components/Menu'
import Footer from '../components/Footer'
export default {
    components: {
        'view-menu': Menu,
        'view-footer': Footer
    },
    data () {
        return {
            counter: 45,
            max: 100
        }
    }
}
</script>

<style lang="less" scoped>
.top-title{
    text-align: center;
    overflow: hidden;
    height: 20rem;
    position: relative;
    & .top-text{
        width:100%;
        padding: 4rem 0;
        line-height: 3.6rem;
        z-index: 9;
        color: #ffffff;
        background: rgba(0,0,0,0.5);
        z-index:2;
        position:absolute;
        top:0;
    }
    & .top-img {
        width: 100%;
        height: 15rem;
        background: url('../assets/image/timeline-top.png');
        background-size: cover;
        opacity: 1;
    }
}
.about {
    & li {
        display: block;
    }
    & .resume{
        text-align: center;
        line-height: 2.6rem;
        margin-bottom: 5rem;
    }
    & .release{
        & li {
            text-align: left;
        }
    }
    }
</style>
