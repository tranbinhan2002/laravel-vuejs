<template>
    <div class="content">
        <div class="content_top">
            <div class="title">Thực Phẩm</div>
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
                        <div class="product_price">Giá bán: {{formatPrice(product.price) }}đ<span>/Kg</span></div>
                        <div class="product_description" v-html="product.description"></div>
                        <div class="product_quantity">
                            <button @click="decreament(index)" class="btn_quantity">-</button>
                                <span>{{product.quantity}}</span>
                            <button @click="increament(index)" class="btn_quantity">+</button>
                        </div>
                    </div>
                </div>
                <div class="product_rigth">
                    <button @click="addToCart(index)" class="btn btn-outline-dark"><i class="fas fa-shopping-cart"> Mua</i></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            products:{},
            carts: [],
            categories: {}
        }
    },
    created(){
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
         increament(product){
            this.products[product].quantity++;
        },
        decreament(product){
            if(this.products[product].quantity > 0){
                this.products[product].quantity--;
            }
            
        },
        formatPrice(value) {
        var formatter = new Intl.NumberFormat('en-US', {
            currency: 'VND',
            minimumFractionDigits: 0
        });
        return formatter.format(value);
    },
        addToCart(product){
            const data = this.products[product];
            if(this.products[product].quantity > 0){
                this.carts.push(data);
                localStorage.setItem('cart',JSON.stringify(this.carts));
                this.$swal.fire({
                icon: "success",
                title: "Đã thêm vào giỏ hàng",
                }); 
            }
            else{
                 this.$swal.fire({
                    icon: "errors",
                    title: "Chưa chọn số lượng",
                });
            }
        }, 
    },


}
</script>

<style lang="scss" scoped>
 .content_top{
        .title{
            font-size: 2rem;
            padding: 3rem;
            text-align: center;
            font-weight: bold;
            font-family: 'Courier New', Courier, monospace;
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
            align-items: center;
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
        .count{
            position: absolute;
            top: 0;
            font-size: 2rem;
        }
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
            }
        }
    }

</style>