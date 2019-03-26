<template>
  <v-content>
    <v-container class="text-xs-center">
      <div class="alert alert-danger" v-if="has_error && !success">
        <p
          v-if="error == 'registration_validation_error'"
        >Validation Error, Please Enter Valid Information.</p>
        <p v-else>Error, System facing an issue at the moment. Please Contact Administrator</p>
      </div>
      <v-card flat>
        <v-card-title primary-title>
          <h4>Register</h4>
        </v-card-title>
        <v-form>
          <v-text-field prepend-icon="person" name="name" v-model="name" label="Full Name"></v-text-field>
          <v-text-field prepend-icon="person" name="email" v-model="email" label="Email"></v-text-field>
          <v-text-field prepend-icon="person" name="phone" v-model="phone" label="Phone Number"></v-text-field>
          <v-text-field
            prepend-icon="lock"
            name="nric"
            v-model="nric"
            label="MyKad Number"
            type="text"
          ></v-text-field>
          <img :src="imageUrl" height="150" v-if="imageUrl">
          <v-text-field
            label="Upload Photo"
            @click="pickFile"
            v-model="imageName"
            prepend-icon="attach_file"
          ></v-text-field>
          <input
            type="file"
            style="display: none"
            ref="image"
            accept="image/*"
            @change="onFilePicked"
          >
          <v-text-field
            prepend-icon="lock"
            name="password"
            v-model="password"
            label="Password"
            type="password"
          ></v-text-field>
          <v-text-field
            prepend-icon="lock"
            name="password"
            v-model="password_confirmation"
            label="Confirm Password"
            type="password"
          ></v-text-field>
          <v-text-field prepend-icon="map" name="city" v-model="city" label="City" type="text"></v-text-field>
          <v-text-field
            prepend-icon="map"
            name="province"
            v-model="province"
            label="Porvince"
            type="text"
          ></v-text-field>
          <v-select
            prepend-icon="map"
            :items="states"
            item-text="value"
            item-value="key"
            label="States"
          ></v-select>
          <v-card-actions>
            <v-btn primary large block @click="register">Submit</v-btn>
          </v-card-actions>
        </v-form>
      </v-card>
    </v-container>
  </v-content>
  <!-- <div class="container">
        <div class="card card-default">
            <div class="card-header">Inscription</div>

            <div class="card-body">
                <div class="alert alert-danger" v-if="has_error && !success">
                    <p v-if="error == 'registration_validation_error'">Erreur(s) de validation, veuillez consulter le(s) message(s) ci-dessous.</p>
                    <p v-else>Erreur, impossible de s'inscrire pour le moment. Si le problème persiste, veuillez contacter un administrateur.</p>
                </div>

                <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">

                    <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.email }">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email">
                        <span class="help-block" v-if="has_error && errors.email">{{ errors.email }}</span>
                    </div>

                    <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" class="form-control" v-model="password">
                        <span class="help-block" v-if="has_error && errors.password">{{ errors.password }}</span>
                    </div>

                    <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
                        <label for="password_confirmation">Confirmation mot de passe</label>
                        <input type="password" id="password_confirmation" class="form-control" v-model="password_confirmation">
                    </div>

                    <button type="submit" class="btn btn-default">Inscription</button>
                </form>
            </div>
        </div>
  </div>-->
</template>
<script>
export default {
  data() {
    return {
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
      city: "",
      phone: "",
      nric: "",
      province: "",
      has_error: false,
      error: "",
      errors: {},
      success: false,
      imageName: "",
      imageUrl: "",
      imageFile: "",
      states: [
        { key: 1, value: "Wilayah Persekutuan" },
        { key: 2, value: "Selangor" },
        { key: 3, value: "Pahang" },
        { key: 4, value: "Perak" },
        { key: 5, value: "Kelantan" },
        { key: 6, value: "Kedah" },
        { key: 7, value: "Negeri Sembilan" }
      ]
    };
  },

  methods: {
    pickFile() {
      this.$refs.image.click();
    },

    onFilePicked(e) {
      const files = e.target.files;
      if (files[0] !== undefined) {
        this.imageName = files[0].name;
        if (this.imageName.lastIndexOf(".") <= 0) {
          return;
        }
        const fr = new FileReader();
        fr.readAsDataURL(files[0]);
        fr.addEventListener("load", () => {
          this.imageUrl = fr.result;
          this.imageFile = files[0]; // this is an image file that can be sent to server...
        });
      } else {
        this.imageName = "";
        this.imageFile = "";
        this.imageUrl = "";
      }
    },
    register() {
      this.snackbar = true;
      var app = this;
      this.$auth.register({
        data: {
          email: app.email,
          password: app.password,
          password_confirmation: app.password_confirmation,
          city: app.city,
          nric: app.nric,
          phone: app.phone,
          state: app.state,
          province: app.province
        },
        success: function() {
          app.success = true;
          this.$router.push({
            name: "login",
            params: { successRegistrationRedirect: true }
          });
        },
        error: function(res) {
          console.log(res.response.data.errors);
          app.has_error = true;
          app.error = res.response.data.error;
          app.errors = res.response.data.errors || {};
        }
      });
    }
  }
};
</script>
