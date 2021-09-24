<template>
   <div class="footer">
        <div class="row align-items-end">
                <router-link class="col bottom" :to="{name: 'home'}">
                    <span>Thực Phẩm</span> 
                </router-link> 
                <div @click="showCart" class="col bottom-mid">
                    <span>Giỏ Hàng</span>
                </div>
                <div @click="showOrder" class="col bottom">
                    <span >Hóa Đơn</span> 
                </div>
         </div>
    </div>
</template>

<script>
export default {
    methods: {
        showCart(){
            const cart = JSON.parse(localStorage.getItem('cart'));
             if(cart == null){
                  this.$swal.fire({
                    icon: "errors",
                    title: "Không có sản phẩm trong giỏ hàng",
                });
             }
             else{
                    this.$router.push({name: 'cart'});
             }
        },
        showOrder(){
            this.$router.push({name: 'receipt'});
        }
    }

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
            cursor: pointer;
        }
        span{
            color: #000;
            font-weight: bold;
            font-size: 1.2rem;
        }
    }
</style>