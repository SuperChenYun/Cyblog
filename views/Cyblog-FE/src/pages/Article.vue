<template>
<div>
    <view-menu/>
    <b-container class="content-body">
        <b-col cols="12" xl="9" class="blog-content">
            <h3>初识 wepy (微信小程序开发框架)</h3>
            <div class="base-info">
                <ul>
                    <li>
                        <span class="iconfont ">&#xe673;</span>: Itzcy
                    </li>
                    <li>
                        <span class="iconfont ">&#xe627;</span>: 1216431
                    </li>
                </ul>
            </div>
            <div class="base-desc"></div>
        </b-col>
        <b-col cols="12" xl="3">
        </b-col>
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
    }
}
</script>

<style lang="less" scoped>
    .content-body {
        text-align: center;
        padding: 3rem 0;
        line-height: 2rem;
        & .base-info{
            padding: 1rem 0;
            & li{
                margin: 0 0.8rem 0 0;
            }
        }
    }
</style>
