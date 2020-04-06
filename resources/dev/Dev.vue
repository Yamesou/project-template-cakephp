<template>
  <div id="app">
    <div class="row">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">
            General Field Handler Components
          </h3>
        </div>
        <div class="box-body">
          <!-- fh/phone.vue -->
          <div class="row">
            <div class="col-xs-12 col-md-6">
              <label>Phone Handler:</label> <br>
              <Phone
                guid="123-123-123"
                field="phone"
                value="8008081"
                @input-value-updated="showPhoneValue"
              />
              <br>
              <pre>
                {{ phoneValue }}
              </pre>
            </div>
          </div>
          <!-- fh/url.vue -->

          <div class="row">
            <div class="col-xs-12 col-md-6">
              <label>Url Handler:</label> <br>
              <Url
                guid="uuid-url"
                field="url_field"
                value="http://localhost"
                @input-value-updated="showUrlValue"
              />
              <br>
              <pre>
                {{ urlValue }}
              </pre>
            </div>
          </div>
          <!-- fh/Boolean.vue -->
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Phone from '@/components/fh/Phone.vue'
import Url from '@/components/fh/Url.vue'

export default {
  components: {
    Phone,
    Url
  },
  data () {
    return {
      phoneValue: {},
      urlValue: {}
    }
  },
  methods: {
    showPhoneValue (field, guid, val) {
      this.phoneValue = {
        'field': field,
        'guid': guid,
        'val': val
      }
    },
    showUrlValue (field, guid, val) {
      this.urlValue = {
        'field': field,
        'guid': guid,
        'val': val
      }
    }
  }
}
</script>
<style>
@import "~admin-lte/dist/css/AdminLTE.min.css";
@import "~admin-lte/dist/css/skins/_all-skins.min.css";

pre {
  border:1px solid #aaa;
  border-radius: 6px;
  background-color: #eee;
}
</style>
