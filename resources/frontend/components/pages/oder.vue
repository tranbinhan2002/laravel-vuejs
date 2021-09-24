<template>
   <div class="content">
        <div class="content_top">
            <div class="title">Hóa Đơn</div>
        </div>
         
       <div class="content_main">
          <div class="content_info">
              <div class="info_left">
                <div class="info">Khách hàng: <span>{{receipt.name}}</span></div>
                <div class="info">Số điện thoại: <span>{{receipt.phone}}</span></div>
                <!-- <div class="info">Ngày: <span>{{order.created_at}}</span></div> -->
                 <div class="info">Địa chỉ: <span>{{receipt.address}}</span></div>
                  <div class="info">Ghi chú: <span>{{receipt.note}}</span></div>
              </div>
              <div class="info_rigth">
                 <div class="info">Mã đơn: <span>{{ codeOrder }}</span></div>
              </div>
          </div>
          <div class="content_product">
                <table class="table">
              <thead>
                <tr>
                  <th scope="col">STT</th>
                  <th scope="col">Tên thực phẩm</th>
                  <th scope="col">Số lượng</th>
                  <th scope="col">Giá</th>
                  <th scope="col">Thành tiền</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(product,index) in receipt.products" :key="index">
                  <th scope="row">{{ index+1 }}</th>
                  <td>{{ product.name }}</td>
                  <td>{{ product.quantity }}</td>
                  <td>{{ formatPrice(product.price) }}đ</td>
                   <td>{{ formatPrice(product.price * product.quantity) }}đ</td>
                </tr>
              </tbody>
            </table>
              <div class="content_bottom">
            Tổng Tiền: <span>{{ formatPrice(receipt.total)}}đ</span>
          <div>
             <button type="submit" @click="accept()" class="btn_checkout">Xác nhận</button>
          </div>
        </div>
          </div>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return{
      receipt: [],
      codeOrder: '',
    }
  },
  created(){
    this.getReceipt()
    this.codeOrder = JSON.parse(localStorage.getItem('orderId'));
  },

  methods: {
    getReceipt(){
      this.receipt = JSON.parse(localStorage.getItem('receipt'));
      console.log(this.receipt);
    },
    accept(){
        this.$swal.fire({
           icon: "success",
           title: "Hãy lưu lại mã hóa đơn và đợi cửa hạng liên hệ",
        });
      localStorage.removeItem('orderId');
      localStorage.removeItem('receipt');
      localStorage.removeItem('cart');
      this.$router.push({name: 'home'});
    },
    formatPrice(value) {
        var formatter = new Intl.NumberFormat('en-US', {
            currency: 'VND',
            minimumFractionDigits: 0
        });
        return formatter.format(value);
    },
  }
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
        padding: 2rem;
        .content_info{
          display: flex;
          justify-content: space-between;
          .info{
            font-size: 1.2rem;
            font-weight: bold;
          }
        }
        .content_product{
          padding-top: 2rem;
        }
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