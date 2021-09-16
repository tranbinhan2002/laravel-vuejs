<template>
   <div class="footer">
        <div class="row align-items-end">
                <router-link class="col bottom" :to="{name: 'home'}">
                    <span>Thực Phẩm</span> 
                </router-link> 
                <router-link class="col bottom-mid" :to="{name: 'cart'}">
                    <span >Giỏ Hàng</span>
                </router-link>
                <router-link class="col bottom" :to="{name: 'order'}">
                    <span >Hóa Đơn</span> 
                </router-link>
         </div>
    </div>
</template>

<script>
export default {

}
</script>

<style lang="scss">
 .footer{
        position: fixed;
        margin: 0 auto;
        left: 0;
        right: 0;
        bottom: 0;
        max-width: 60rem;
        .col{
            background-color: cadetblue;
            padding: 15px; 
            text-align: center;
        }
        .bottom-mid{
            margin: 0px 5px;
        }
        span{
            color: #000;
            font-weight: bold;
            font-size: 1.2rem;
        }
    }
</style>