<template>

    <footer class="footer">
        <div class="footer-content">
            <b-container>
            </b-container>
        </div>
        <div class="footer-copyright">
            <b-container>
                <ul>
                    <li> <a href="">Github</a></li>
                    <li> <a href="">bilibili</a></li>
                    <li> <a href="">Private Server</a></li>
                </ul>
                <hr class="line">

                <span class="left">@2014 - {{nowYear}} By {{nowDomain}}</span>
                <span class="right"> 冀ICP备12003293号 冀公网安备13070902000223号 </span>
            </b-container>
        </div>
    </footer>
</template>

<script>
export default {
    data () {
        return {
        }
    },
    computed: {
        nowYear: function () {
            var date = new Date()
            return date.getFullYear()
        },
        nowDomain: function () {
            return window.location.hostname
        }
    }
}
</script>

<style lang="less" scoped>
    .footer{
        background: #313131;
        width: 100%;
        text-align: center;
        min-height: 24rem;
        position: relative;
        & .footer-content{
            width: 100%;
        }
        & .footer-copyright{
            position: absolute;
            bottom: 0;
            width: 100%;
            background: #000000;
            color: #a9a9a9;
            min-height:2.333rem;
            line-height: 2.333rem;
            font-size:1rem;
            text-align: right;
            & .left {
                text-align:left;
                float: left;
                left: 0;
            }
            & .right{
                text-align:right;
                float: right;
            }
            & .line {
                color:#666666;
                height:1px;
                border:0;
                border-top:1px solid #666666;
                margin:0.333rem 0;
                padding:0;
                overflow:hidden;
            }
            & ul {
                text-align: right;
                & li {
                    margin: 0 0.333rem;
                    & a, a:visited, a:hover {
                        color: #a9a9a9;
                        text-decoration-line: none;
                    }
                    a:hover{
                        color: #ffffff;
                        text-decoration-line:initial
                    }
                }
            }

        }
    }
</style>
