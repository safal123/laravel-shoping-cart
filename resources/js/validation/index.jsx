export const required = value => value ? undefined : 'This field is required.'
// export const maxLength = max => value =>
//   value && value.length > max ? `Must be ${max} characters or less` : undefined
export const email = value =>
  value && !/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i.test(value) ?
    'Invalid email address' : undefined
export const minValue = min => value =>
  value && value.length < min ? `Must be at least ${min}` : undefined