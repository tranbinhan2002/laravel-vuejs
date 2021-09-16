<template>
    <div class="content">
        <div class="content_top">
            <div class="title">Danh Sách Thực Phẩm</div>
           <div class="category">
               <span @click.prevent="getProduct()">Tất cả</span>
                <span v-for="category in categories" :key="category.id">
                   <span @click.prevent="productFilter(category.id)">{{category.name}} </span> 
                </span>
           </div>
        </div>
       <div class="content_main">
            <div v-for="(product,index) in products" :key="index" class="content_product">
                <div class="product_left">
                    <div class="product_image">
                        <img class="image" :src="product.image" alt="">
                    </div>
                    <div class="product_detail">
                        <div class="product_name">{{product.name}}</div>
                        <div class="product_price">Giá bán: {{product.price}}đ<span>/Kg</span></div>
                        <div class="product_description">Bán theo kg</div>
                        <div class="product_quantity">
                            <button @click="decreament(index)" class="btn_quantity">-</button>
                                <span>{{product.quantity}}</span>
                            <button @click="increament(index)" class="btn_quantity">+</button>
                        </div>
                    </div>
                </div>
                <div class="product_rigth">
                    <button @click="selectProduct(index)" class="btn btn-outline-dark"><i class="fas fa-shopping-cart"> Chọn</i></button>
                </div>
            </div>
        </div>
        <div @click="showCart()" class="cart">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="modal fade" id="cart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Giỏ Hàng</h5>
                    <button @click="hideCart()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="content_main">
                        <div class="content_product" v-for="(cart,index) in dataCart" :key="index">
                            <div class="product_left">
                                <div class="product_image">
                                    <img class="image" :src="cart.image" alt="">
                                </div>
                                <div class="product_detail">
                                    <div class="product_name">{{cart.name}}</div>
                                    <div class="product_price">Giá bán: {{cart.price}}đ<span>/Kg</span></div>
                                    <div class="product_quantity">Số lượng: {{cart.quantity}}</div>
                                </div>
                            </div>
                            <div class="product_rigth">
                                <button @click="deleteProductCart(cart)" class="btn btn-outline-dark">X</button>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
                <button @click="hideCart()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" @click="checkOut()" class="btn btn-primary">Mua Hàng</button>
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
            count: 0,
            products:{},
            carts: [],
            dataCart: [],
            categories: {}
        }
    },
    created(){
        this.getCart();
        this.getCategory();
        this.getProduct();
    },
    methods: {
        getCategory(){
            this.callApi('get','/api/fresh-category').then(res => {
                this.categories = res.data;
            });
        },
        getProduct(){
             this.callApi('get','/api/fresh-product').then(res => {
                this.products = res.data.data;
            });
        },
        productFilter(id){
            this.callApi('get',`/api/filter-product/${id}`).then(res=> {
                this.products = res.data.data;
            });
        },
         increament(index){
            this.products[index].quantity++
        },
        decreament(index){
            if(this.products[index].quantity > 0){
                this.products[index].quantity--
            }
            
        },
        selectProduct(index){
            const data = this.products[index];
            if(this.products[index].quantity > 0){
                this.carts.push(data);
                localStorage.setItem('cart',JSON.stringify(this.carts));
                this.$swal.fire({
                icon: "success",
                title: "Đã thêm vào giỏ hàng",
                });
                this.getCart();
            }
            else{
                 this.$swal.fire({
                    icon: "errors",
                    title: "Chưa chọn số lượng",
                });
            }
           
        },
        getCart(){
             this.dataCart = JSON.parse(localStorage.getItem('cart'));
        },
        deleteProductCart(cart){
             this.dataCart.splice(this.dataCart.indexOf(cart), 1);
              localStorage.setItem('cart',JSON.stringify(this.dataCart));
            this.getCart();
        },
        showCart(){
             $("#cart").modal("show");
        },
        hideCart(){
             $("#cart").modal("hide");
        },
        checkOut(){
             this.$router.push({name: 'cart'});
              $("#cart").modal("hide");
        }
        
    },


}
</script>

<style lang="scss" scoped>
 .content_top{
        font-size: 1.5rem;
        padding-top: 2rem;
        .title{
            padding: 1rem;
        }
        .category{

            font-size: 1.2rem;
            font-weight: bold;
            span{
                margin: 1rem 0.5rem;
                cursor: pointer;
            }
        }

    }
.content_main{
        padding-bottom: 4rem;
        .content_product{
            display: flex;
            justify-content: space-between;
            font-size: 1.3rem;
            font-weight: bold;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px 0 rgba(0, 85, 255, 0.1);
            align-products: center;
            padding: 1rem;
            margin-top: 1rem;
            .product_left{
                display: flex;
                .product_price{
                    font-size: 1.2rem;
                }
                .product_image{
                    .image{
                        width: 10rem;
                        height: 7rem;
                    }
                }
                .product_detail{
                    padding-left: 1rem;
                    .product_description{
                        font-size: 1rem;
                    }
                    .product_quantity{
                        padding-top: 1rem;
                        .btn_quantity{
                            width: 3rem;
                            height: 2rem;
                        }
                        span{
                                margin: 0 0.5rem;
                        }
                    }
                }
            }
        }
    }
.cart{
        position: fixed;
        top: 20%;
        right: 20%;
        cursor: pointer;
        font-size: 2rem;
    }
    .modal-body{
        .content_main{
            .content_product{
                .product_left{
                    .product_image{
                        .image{
                            width: 7rem;
                            height: 5rem;
                        }
                    }
                    .product_detail{
                         .product_price{
                        font-size: 1rem;
                        }
                        .product_description{
                        font-size: 1rem;
                    }
                        .product_quantity{
                            font-size: 1rem;
                            padding-top: 0;
                        }
                    }
                }
                .product_rigth{

                }
            }
        }
    }

</style>