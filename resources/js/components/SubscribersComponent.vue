<template>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-8 mt-5">
        <h1 class="lead-text text-center mb-5">Subscribe to our newsletter.</h1>

        <h3 v-if="successMessage != null" class="mb-5 text-center text-success">{{ successMessage }}</h3>

        <form @submit.prevent="onSubmit" novalidate>
          <div class="form-row">
            <div class="col-md-3 mb-3 input-group-lg">
              <label for="validationCustom01" class="lead-text">Full Name</label>
              <input type="text" class="form-control" id="validationCustom01" placeholder="Full Name" v-model.trim="form.fullName" required>
              <div class="error text-danger" v-if="!$v.form.fullName.required">
                Field is required.
              </div>

              <div class="error text-danger" v-if="!$v.form.fullName.minLength">
                Name must have at least {{$v.form.fullName.$params.minLength.min}} letters.
              </div>
            </div>

            <div class="col-md-3 mb-3 input-group-lg">
              <label for="validationCustom02" class="lead-text">Title</label>
              <input type="text" class="form-control" id="validationCustom02" v-model.trim="form.title" placeholder="Example Title" required>
              <div class="error text-danger" v-if="!$v.form.title.required">
                Field is required.
              </div>

              <div class="error text-danger" v-if="!$v.form.title.minLength">
                Title must have at least {{$v.form.title.$params.minLength.min}} letters.
              </div>
            </div>

            <div class="col-md-3 mb-3 input-group-lg">
              <label for="validationCustom03" class="lead-text">Email</label>
              <input type="email" class="form-control" id="validationCustom03" v-model.triem="form.email" placeholder="example@example.com" required>
              <div class="error text-danger" v-if="!$v.form.email.required">
                Field is required.
              </div>

              <div class="error text-danger" v-if="!$v.form.email.email">
                Not a valid email.
              </div>

              <div class="error text-danger" v-if="emailErrorMessage != null">
                {{ emailErrorMessage }}
              </div>
            </div>

            <div class="col-md-2 mb-3 input-group-lg">
              <label></label>
              <button class="form-control btn btn-primary mt-2 text-uppercase subscribe-btn" type="submit">Sign Up</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  import { required, minLength, email } from 'vuelidate/lib/validators';

  export default {
    name: 'SubscribersComponent',
    data() {
      return {
        emailErrorMessage: null,
        successMessage: null,
        form: {
          fullName: '',
          title: '',
          email: ''
        }
      }
    },

    //Task validation
    validations: {
      form: {
        fullName: {
          required,
          minLength: minLength(3)
        },
        title: {
          required,
          minLength: minLength(3)
        },
        email: {
          required,
          email
        }
      }
    },

    methods: {
      onSubmit() {

        axios.post('api/subscriber', this.form, {
          crossDomain: true,
          headers: {
            'Access-Control-Allow-Origin':  '*',
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'signature': 'asd',
            'Access-Control-Allow-Headers': 'X-Requested-With',
            'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE',
            data:{}
          }
        }).then(response => {

          if (typeof response.data.error != 'undefined' && Object.keys(response.data.error).length > 0) {
            this.emailErrorMessage = response.data.error[0];
            return false;
          }

          this.emailErrorMessage = '';
          this.form.fullName = '';
          this.form.title = '';
          this.form.email = '';
          this.successMessage = response.data.success;
        })
        .catch(error => {
          console.log('Error ', error);
        });
      },
    },

    mounted() {

    }
  }
</script>
