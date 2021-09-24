<template>
   <div class="content">
          <div class="content_top">
              <div class="title">Hóa Đơn</div>
          </div>
          <div v-if="checkPhone" class="form-group">
              <label>Nhập số điện thoại: </label>
              <input v-model="phone" type="number">
              <button @click="getOrder()">Xem</button>
            </div>
        <div v-for="order in orders.data" :key="order.id" class="content_main">
          <div class="content_info">
              <div class="info_left">
                <div class="info">Khách hàng: <span>{{order.name}}</span></div>
                <div class="info">Số điện thoại: <span>{{order.phone}}</span></div>
                 <div class="info">Ngày: <span>{{order.created_at}}</span></div>
                 <div class="info">Địa chỉ: <span>{{order.address}}</span></div>
                  <div class="info">Ghi chú: <span>{{order.note}}</span></div>
              </div>
              <div class="info_rigth">
                 <div class="info">Mã đơn: <span>{{ order.id }}</span></div>
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
                <tr v-for="(product,index) in order.products" :key="index">
                  <th scope="row">{{ index+1 }}</th>
                  <td>{{ product.name }}</td>
                  <td>{{ product.pivot.quantity }}</td>
                  <td>{{ formatPrice(product.price) }}đ</td>
                  <td>{{ formatPrice(product.price * product.pivot.quantity) }}đ</td>
                </tr>
              </tbody>
            </table>
              <div class="content_bottom">
                  Tổng Tiền: <span>{{ formatPrice(order.total)}}đ</span>
              <div>
                <div class="pagination">
              <pagination :data="orders" @pagination-change-page="getOrder">
                <span slot="prev-nav">&lt; Prev</span>
                <span slot="next-nav">Next &gt;</span>
              </pagination>
            </div>
             <button type="submit" class="btn_checkout">Thoát</button>
          </div>
          </div>
          </div>
        </div>
      </div>
</template>

<script>
export default {
  data(){
    return{
      orders: {},
      phone: '',
      checkPhone: true
    }
  },
  methods: {
    getOrder(page = 1){
      this.callApi('get',`/api/receipt/?page=${page}&search=${this.phone}`).then(res => {
        this.orders = res.data;
        this.checkPhone = false;
      })
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
      padding-bottom: 2rem;
      .btn_checkout{
        margin-top: 1rem;
        padding: 0.5rem;
      }
    }


</style>