<template>
    <div class="content">
        <div class="content_top">
            <div class="title">Đơn Hàng</div>
        </div>
       <div class="content_main">
            <div class="content_product">
                <div class="product_left">
                    <div class="product_image">
                        <img class="image" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRb1uoNor8c3M1p6AvrX2EfvOgxGUJkjS0ycw&usqp=CAU" alt="">
                    </div>
                    <div class="product_detail">
                        <div class="product_name">Cua</div>
                        <div class="product_price">Giá bán: 350000đ<span>/Kg</span></div>
                        <div class="product_quantity">Số lượng: 2</div>
                        <div class="product_price">Thành tiền: 700000đ</div>
                    </div>
                </div>
                <div class="product_rigth">
                    <button class="btn btn-outline-dark">X</button>
                </div>
            </div>
             <div class="content_product">
               
            </div>
        </div>
        <div class="content_bottom">
          Tổng Tiền: <span>1400000đ</span>
          <div>
             <button class="btn_checkout">Thanh Toán</button>
          </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
.content{
   background-color: rgb(239, 241, 241);
   height: 100vh;
}
 .content_top{
        font-size: 1.5rem;
        padding-top: 2rem;
        .title{
            padding: 1rem;
        }
    }
    .content_main{
        padding-bottom: 3rem;
       
    }
    .content_bottom{
      font-size: 1.3rem;
      text-align: right;
      padding-right: 2rem;
      .btn_checkout{
        margin-top: 1rem;
        padding: 0.5rem;
      }
    }
</style>