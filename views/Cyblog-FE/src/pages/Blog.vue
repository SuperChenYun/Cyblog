<template>
  <div>
    <view-menu/>
    <b-container class="content-body">
        <b-col cols="12" xl="9"  class="article-list">
            <!-- <h2>随机文章</h2> -->
            <ul>
                <li class="item-li" v-for="(item, index) in items" :key="item.id">
                    <article-item :item="item" :index="index"/>
                </li>
            </ul>
        </b-col>
        <b-col cols="12" xl="3" class="sidebar">
            <div>
                <h2>标签云</h2>
                <!-- <tag/> -->
            </div>
        </b-col>
    </b-container>
    <view-footer/>
  </div>
</template>

<script>
import Menu from '../components/Menu'
import Footer from '../components/Footer'
import AritcleItem from '../components/ArticleItem'
import Tag from '../components/Tag'
export default {
    components: {
        'view-menu': Menu,
        'view-footer': Footer,
        'article-item': AritcleItem,
        'tag': Tag
    },
    data () {
        return {
            message: 'Hello Vue!',
            items: [
                {
                    'id': 1,
                    'title': '初识WEPY 小程序开发利器',
                    'top_img': 'http://192.168.1.11/static/img/1e0b5bf2beda23a2f84023efa2d8ebef.png'
                },
                {
                    'id': 1,
                    'title': '初识WEPY 小程序开发利器',
                    'top_img': 'http://192.168.1.11/static/img/2.jpg'
                },
                {
                    'id': 1,
                    'title': '初识WEPY 小程序开发利器',
                    'top_img': 'http://192.168.1.11/static/img/11.jpg'
                }
            ]
        }
    }
}
</script>

<style lang="less" scope>
.content-body {
    width: 100%;
    position: relative;
    overflow: hidden;
    & .article-list{
        overflow: hidden;
        margin-bottom: 3rem;
        margin-top: 3rem;
        display: inline-block;
        & .item-li {
            // display: block;
            width: 100%;
        }
    }
    & .sidebar{
        float: right;
        margin-bottom: 3rem;
        margin-top: 3rem;
        overflow: hidden;
        // display: inline-block
    }
}
</style>
