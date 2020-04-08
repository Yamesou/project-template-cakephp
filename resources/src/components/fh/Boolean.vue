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
    <input
      v-model="val"
      type="checkbox"
      class="square"
    >
  </div>
</template>

<script>
import $ from 'jquery'
import icheck from 'icheck'

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
      type: [String, Number],
      default: 0
    },
    label: {
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
      val: +this.value
    }
  },
  watch: {
    val () {
      this.$emit('input-value-updated', this.field, this.guid, this.val)
    }
  },
  mounted () {
    const self = this
    const $input = $(this.$el).find('input')

    $input.iCheck({
      checkboxClass: 'icheckbox_square',
      radioClass: 'iradio_square'
    })

    $input.on('ifChecked', function (e) {
      self.val = 1
    })

    $input.on('ifUnchecked', function (e) {
      self.val = 0
    })
  }
}
</script>
<style lang="css">
  @import '~icheck/skins/square/_all.css';
</style>
