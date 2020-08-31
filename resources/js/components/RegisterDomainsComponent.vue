<template>
  <div>
    <form method="POST" enctype="multipart/form-data" @submit.prevent="submitDomain">
      <div class="form-group">
        <label for="category">Select a Category</label>
        <select class="form-control" id="category" v-model="form.category_id">
          <option
            v-for="category in this.categories"
            :key="category.id"
            :value="category.id"
          >{{category.category_name}}</option>
        </select>
      </div>
      <div class="form-group">
        <label for="subcategory">Select Subcategory</label>
        <select class="form-control" id="subcategory" v-model="form.subcategory_id">
          <option
            v-for="subcat in this.filteredSubcategories"
            v-bind:key="subcat.id"
            :value="subcat.id"
          >{{subcat.subcategory_name}}</option>
        </select>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="email">Email</label>
          <input
            type="text"
            name="email"
            :class="{'is-invalid' : form.errors.has('email')}"
            class="form-control"
            placeholder="Please enter your email address"
            v-model="form.email"
            @keydown="form.errors.clear('email')"
          />
          <div
            class="invalid-feedback"
            v-show="form.errors.has('email')"
            v-text="form.errors.get('email')"
          ></div>
        </div>
        <div class="form-group col-md-6">
          <label for="url">Enter your domain URL</label>
          <input
            type="text"
            name="url"
            :class="{'is-invalid' : form.errors.has('url')}"
            class="form-control"
            placeholder="https://your.domain.com"
            v-model="form.url"
            @keydown="form.errors.clear('url')"
          />
          <div
            class="invalid-feedback"
            v-show="form.errors.has('url')"
            v-text="form.errors.get('url')"
          ></div>
        </div>
      </div>
      <div class="input-group mb-3">
        <input type="file" class="form-control-file" id="img" />
      </div>
      <div class="form-group">
        <label for="title">Title of your Domain</label>
        <input
          type="text"
          :class="{'is-invalid' : form.errors.has('title')}"
          class="form-control"
          name="title"
          placeholder="Title"
          v-model="form.title"
          @keydown="form.errors.clear('title')"
        />
        <div
          class="invalid-feedback"
          v-show="form.errors.has('title')"
          v-text="form.errors.get('title')"
        ></div>
      </div>
      <div class="form-group">
        <label for="shortdescription">Short Description of your Domain</label>
        <input
          type="text"
          :class="{'is-invalid' : form.errors.has('shortdescription')}"
          class="form-control"
          name="shortdescription"
          placeholder="Short Description"
          v-model="form.shortdescription"
          @keydown="form.errors.clear('shortdescription')"
        />
        <div
          class="invalid-feedback"
          v-show="form.errors.has('shortdescription')"
          v-text="form.errors.get('shortdescription')"
        ></div>
      </div>
      <div class="form-group">
        <label for="description">Description of your Domain</label>
        <vue-editor id="category_description" placeholder="Description" v-model="form.description" />
      </div>
      <div class="mx-auto w-50" >
        <button class="btn btn-success" type="submit">Submit</button>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  props: ["categories", "subcategories"],
  data() {
    return {

      form: new Form({
        email: "",
        title: "",
        url: "",
        shortdescription: "",
        description: "",
        category_id: "",
        subcategory_id: "",
      }),
    };
  },

  methods: {
    
    submitDomain() {
      let data = new FormData();
      data.append("title", this.form.title);
      data.append("email", this.form.email);
      data.append("url", this.form.email);
      data.append("shortdescription", this.form.shortdescription);
      data.append("description", this.form.description);
      data.append("category_id", this.form.category_id);
      data.append("subcategory_id", this.form.subcategory_id);
      if (document.getElementById("img").files[0]) {
        data.append("img", document.getElementById("img").files[0]);
      }
      axios
        .post("/domain", data)
        .then((response) => {
          
          this.form.reset();
          window.location.href="../"
        })
        .catch((error) => this.form.errors.record(error.response.data));
    },
  },
  computed: {
    filteredSubcategories: function () {
      return this.subcategories.filter(
        (item) => item.category_id === this.form.category_id
      );
    },
  },
};
</script>