<template>
    <div>
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div :class="`alert alert-${isError ? 'danger' : 'success'} alert-dismissible fade show`" role="alert" v-if="isError || isSuccess">
                            {{ isError ? error_messages[0] : success_messages[0] }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" v-on:click="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card card-primary">
                            <div class="card-header text-center">
                                 <h4>{{ $store.state.brand }}</h4>
                            </div>

                            <div class="card-body">
                                <form @submit.prevent="login">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <ValidationProvider rules="required|min:4" v-slot="{ errors }">
                                            <input v-model="form.username" @input="strfilter" id="username" type="text" :class="errors.length ? 'form-control is-invalid' : 'form-control'" tabindex="1" placeholder="syawal" autofocus>
                                            <div class="invalid-feedback">
                                                {{ errors[0] }}
                                            </div>
                                        </ValidationProvider>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                            <div class="float-right" v-if="hitError >= 3">
                                               <a href="" class="text-small">
                                                   Forgot Password?
                                               </a>
                                            </div>
                                       </div>
                                       <ValidationProvider rules="required|min:4" v-slot="{ errors }">
                                           <input aria-describedby="passwordHelpBlock" v-model="form.password" id="password" type="password" :class="errors.length ? 'form-control is-invalid' : 'form-control'" tabindex="2" placeholder="****">
                                           <div class="invalid-feedback">
                                                {{ errors[0] }}
                                           </div>
                                       </ValidationProvider>
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" :disabled="!form.username || !form.password">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="simple-footer text-center mt-3">
                            Copyright &copy; {{ $store.state.brand }} {{ year }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import { ValidationProvider } from 'vee-validate'
    import { mapState } from 'vuex'
    export default {
        data() {
            return {
               form: {
                   username: '',
                   password: ''
               },
               year: new Date().getFullYear(),
               hitError: 0,
               forgotPass: false,
            }
        },
        computed: {
            ...mapState({
                error_messages: state => state.error_messages,
                success_messages: state => state.success_messages,
                isError: state => state.isError,
                isSuccess: state => state.isSuccess,
            }),
        },
        methods: {
            async login() {
                try {
                    let { data } = await this.$store.dispatch('login', { value: this.form })
                    let { user } = data
                    console.log('success:', data)
                } catch (e) {
                    console.log(e)
                }
            },
            close() {
                this.$store.dispatch('close')
                this._hitError()
            },
            _hitError(){
                ++this.hitError
            },
            strfilter(v) {
                this.form.username = this.form.username.replace(/\@|\<|\>|\/|\(|\)/g, '')
            }

        },
        components: {
            ValidationProvider
        }
    }
</script>
