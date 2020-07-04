<template>
  <div class="flex-col">
    <label for="form-passwordField" class="text-lg font-normal text-gray-700 w-auto">
      Password Field
      <span class="text-sm text-red-500 font-bold">*</span>
    </label>

    <SelectField
      id="form-passwordField"
      :errors="errors"
      v-model="passwordField"
    >
      <template v-slot:options>
        <option
          v-for="row in fields"
          :key="`passwordfield-${row.id}`"
          :value="row.id"
        >
          {{ row.name }}
        </option>
      </template>
    </SelectField>
  </div>
</template>

<script>
import { get } from 'lodash'
import SelectField from '@/Adaptcms/Base/ui/components/Form/SelectField'

export default {
  props: [
    'value',
    'field',
    'package',
    'errors',
    'fields'
  ],

  components: {
    SelectField
  },

  watch: {
    value (newVal, oldVal) {
      if ((newVal !== oldVal) && get(newVal, 'passwordField', null)) {
        this.passwordField = newVal.passwordField
      }
    },

    passwordField (newVal, oldVal) {
      if (newVal !== oldVal) {
        this.$emit('input', { passwordField: newVal })
      }
    }
  },

  data () {
    return {
      passwordField: null
    }
  },

  mounted () {
    if (!this.passwordField && get(this.value, 'passwordField', null)) {
      this.passwordField = this.value.passwordField
    } else {
      this.passwordField = this.fields[0].id
    }
  }
}
</script>
