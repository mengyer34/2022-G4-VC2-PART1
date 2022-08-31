export default ({ store, next }) => {
    if (store.state.role !== 'admin') {
      next("/")
      return false
    }
    next()
  }