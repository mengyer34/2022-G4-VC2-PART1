export default ({ store, next }) => {
    if (store.state.role !== 'user') {
      next("/dashboard")
      return false
    }
    next()
  }