<template>
   <div class="content">
        <div class="content_top">
            <div class="title">Thông Tin Khách Hàng</div>
        </div>
         
       <div class="content_main">
          <form @submit.prevent="order()">
            <div class="mb-3">
              <label class="form-label">Tên khách hàng</label>
              <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" type="text" class="form-control">
                <div
              v-if="form.errors.has('name')"
              v-html="form.errors.get('name')"
            />
            </div>
            <div class="mb-3">
              <label class="form-label">Số điện thoại</label>
              <input v-model="form.phone" :class="{ 'is-invalid': form.errors.has('phone') }" type="number" class="form-control">
                <div
              v-if="form.errors.has('phone')"
              v-html="form.errors.get('phone')"
            />
            </div>
            <div class="mb-3">
              <label class="form-label">Địa chỉ</label>
              <input v-model="form.address" :class="{ 'is-invalid': form.errors.has('address') }" type="text" class="form-control">
                 <div
              v-if="form.errors.has('address')"
              v-html="form.errors.get('address')"
            />
            </div>
             <div class="mb-3">
              <label class="form-label">Ghi chú</label>
              <textarea v-model="form.note" class="form-control"></textarea>
            </div>
             <div class="content_bottom">
            Tổng Tiền: <span>{{ formatPrice(form.total) }}đ</span>
          <div>
             <button type="submit" class="btn_checkout">Xác nhận</button>
          </div>
        </div>
              </form>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return{
      form: new Form({
          name: '',
          phone: '',
          address: '',
          note: '',
          total:0,
          products: [],
      }),
      listCart: [],
    }
  },
  created(){
    const dataLocal = JSON.parse(localStorage.getItem('cart'));
    this.listCart = dataLocal ? dataLocal : [];
    this.totalPrice();
    this.form.products = this.listCart;
    this.listCart.forEach((item, index)=>{
       this.form.total += item.price * item.quantity;
    });
  },
  methods: {
     totalPrice(price,quantity){
        return price * quantity;
      },
    order(){
       this.$swal
        .fire({
          title: "Xác nhận thanh toán",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes",
        })
        .then((result) => {
          if (result.isConfirmed) {
             this.form.post('/api/order').then(res => {
                   if(res.status == 200){
                     localStorage.setItem('orderId',JSON.stringify(res.data.id));
                    this.$swal.fire({
                        icon: "success",
                        title: "Đặt hàng thành công, Hãy lưu lại mã hóa đơn",
                    });
                    localStorage.setItem('receipt',JSON.stringify(this.form));
                    this.$router.push({name: 'order'});
                  } 

             });
          }
      });

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