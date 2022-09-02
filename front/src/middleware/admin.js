export default ({ store, next }) => {
    if (store.state.role !== 'admin' && store.state.role !== undefined) {
      next("/")
      return false
    }
    next()
  }