export default ({ store, next }) => {
    if (store.state.role !== 'user' && store.state.role !== undefined) {
      next("/dashboard")
      return false
    }
    next()
  }