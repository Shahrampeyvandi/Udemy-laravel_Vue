<template>
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="card card-shadowed p-50 w-400 mb-0" style="max-width: 100%">
          <h5 class="text-uppercase text-center">ورود</h5>
          <br><br>
          <form>

            <!--show errors to page-->

            <ul class="alert alert-danger" v-if="errors.length > 0">
              <li class="text-center" v-for="error in errors" :key="errors.indexOf(error)">
                {{ error }}
              </li>
            </ul>
            <div class="form-group">
              <input type="text" class="form-control text-right" placeholder="ایمیل" v-model="email">
            </div>

            <div class="form-group">
              <input type="password" class="form-control text-right" placeholder="رمز عبور" v-model="password">
            </div>

            <div class="form-group flexbox py-10">
              <label class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" v-model="remember">
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">مرا به خاطر بسپار</span>
              </label>

              <a class="text-muted hover-primary fs-13" href="#">رمز عبور خود را فراموش کرده اید؟</a>
            </div>

            <div class="form-group">
              <button class="btn btn-bold btn-block btn-primary" @click="attemptLogin()" :disabled="!isValidLoginForm" type="button">تایید</button>
            </div>
          </form>
          <p class="text-center text-muted fs-13 mt-20">Don't have an account? <a href="page-register.html">Sign up</a></p>
        </div>
      </div>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        data() {
          return {
            email: '',
            password: '',
            remember: true,
            loading: false,
            errors: []
          }
        },

        methods: {
          emailIsValid()   {  
          if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email))  {  
              return true
            } else { 
              return false 
            }
          },
          attemptLogin() {
            this.errors = [];  //ارایه را خالی میکنیم
            this.loading = true;
            axios.post('/login', {
              email: this.email, password: this.password, remember: this.remember
            }).then(resp => {
              location.reload()
            }).catch(error => {
              this.loading = false ;
              if(error.response.status == 422) {
                this.errors.push("اطلاعات وارد شده صحیح نمی باشند")
              } else {
                this.errors.push("Something went wrong , please refresh and try again.")
              }
            })
          }
        },

       computed: {
         isValidLoginForm(){
            return this.emailIsValid() && this.password && !this.loading
         }
       }
    }
</script>
