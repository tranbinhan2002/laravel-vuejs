<template>
   <div class="content">
        <div class="content_top">
            <div class="title">Giỏ Hàng</div>
        </div>
       <div class="content_main">
            <div class="content_product" v-for="product in listCart " :key="product.id">
                <div class="product_left">
                    <div class="product_image">
                        <img class="image" :src="product.image" alt="">
                    </div>
                    <div class="product_detail">
                        <div class="product_name">{{product.name}}</div>
                        <div class="product_price">Giá bán: {{formatPrice(product.price)}}đ<span>/Kg</span></div>
                        <div class="product_quantity">Số lượng: {{product.quantity}}</div>
                        <div class="product_price">Thành tiền: {{formatPrice(product.price * product.quantity)}}đ</div>
                    </div>
                </div>
                <div class="product_rigth">
                    <button @click="deleteProduct(product)" class="btn btn-outline-dark">X</button>
                </div>
            </div>
             <div class="content_bottom">
          Tổng Tiền: <span>{{ formatPrice(total)}}đ</span>
          <div>
             <button @click="checkout()" class="btn_checkout">Thanh toán</button>
          </div>
        </div>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return{
      listCart: [],
      total: 0,
    }
  },
  created(){
    this.getCart();
  },
  methods: {
        getCart(){
            const cart = JSON.parse(localStorage.getItem('cart'));
            this.listCart = cart ? cart : [];
              this.listCart.forEach((item,index)=> {
                    this.total += item.price * item.quantity;
             }) ; 
        },
         formatPrice(value) {
        var formatter = new Intl.NumberFormat('en-US', {
            currency: 'VND',
            minimumFractionDigits: 0
        });
        return formatter.format(value);
    },
      checkout(){
          if(this.listCart == 0){
               this.$swal.fire({
                    icon: "errors",
                    title: "Không thể thanh toán khi không có sản phẩm nào",
                });
                 this.$router.push({name: 'home'});
          }else{
                this.$router.push({name: 'checkout'});
          }
           
      },
      deleteProduct(product){
        this.listCart.splice(this.listCart.indexOf(product), 1);
        localStorage.setItem('cart',JSON.stringify(this.listCart));
        this.getCart();
      }
  },



}
</script>

<style lang="scss" scoped>
.content{
   background-color: rgb(239, 241, 241);
   height: 100vh;
}
 .content_top{
             .title{
            font-size: 2rem;
            padding: 3rem;
            text-align: center;
            font-weight: bold;
            font-family: 'Courier New', Courier, monospace;
        }
    }
    .content_main{
        padding-bottom: 3rem;
        .content_product{
            display: flex;
            justify-content: space-between;
            font-size: 1.3rem;
            font-weight: bold;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px 0 rgba(0, 85, 255, 0.1);
            align-items: center;
            padding: 1rem;
            margin-top: 1rem;
            .product_left{
                display: flex;
                .product_price{
                    font-size: 1rem;
                }
                .product_image{
                    .image{
                        width: 7rem;
                        height: 5rem;
                    }
                }
                .product_detail{
                    padding-left: 1rem;
                    .product_description{
                        font-size: 1rem;
                    }
                    .product_quantity{
                       font-size: 1rem;
                    }
                }
            }
        }
    }
    .content_bottom{
      font-size: 1.3rem;
      text-align: right;
      padding-right: 2rem;
      padding-top: 2rem;
      padding-bottom: 2rem;
      .btn_checkout{
        margin-top: 1rem;
        padding: 0.5rem;
      }
    }

</style>