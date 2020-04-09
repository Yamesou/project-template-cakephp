<template>
  <div
    :class="{'required': isRequired}"
    class="form-group"
  >
    <label
      v-if="label !== ''"
      :for="guid"
      class="control-label"
    >
      {{ label }}
    </label>
    <div
      :class="[sizeClass]"
      class="input-group bootstrap-timepicker timepicker"
    >
      <div class="input-group-addon">
        <i class="fa fa-clock-o" />
      </div>
      <input
        v-model="val"
        type="text"
        autocomplete="off"
        class="form-control"
      >
    </div>
  </div>
</template>

<script>
import * as $ from 'jquery'
import timepicker from 'bootstrap-timepicker'

export default {
  props: {
    field: {
      type: String,
      required: true
    },
    guid: {
      type: String,
      required: true
    },
    value: {
      type: String,
      default: ''
    },
    label: {
      type: String,
      default: '',
      required: false
    },
    size: {
      type: String,
      default: '',
      required: false
    },
    isRequired: {
      type: Boolean,
      default: false,
      required: false
    }
  },
  data () {
    return {
      val: this.value
    }
  },
  computed: {
    sizeClass () {
      if (this.size === 'input-sm') {
        return 'input-group-sm'
      }

      return this.size
    }
  },
  watch: {
    val () {
      this.$emit('input-value-updated', this.field, this.guid, this.val)
    }
  },
  mounted () {
    const self = this

    $(this.$el).find('input').timepicker({
      showMeridian: false,
      minuteStep: 5,
      defaultTime: false
    }).on('changeTime.timepicker', function (e) {
      self.val = e.time.value
    })
  }
}
</script>
<style lang="css">
  @import '~bootstrap-timepicker/css/bootstrap-timepicker.min.css';

  .bootstrap-timepicker .input-group-addon i {
      width: auto !important;
      height: auto !important;
  }
</style>
