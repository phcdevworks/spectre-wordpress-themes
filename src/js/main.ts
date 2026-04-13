import '../styles/main.css'

// The theme ships one JS entry and one CSS bundle emitted from this import.
console.log('Spectre WordPress Themes loaded')

if (import.meta.hot) {
  import.meta.hot.accept(() => {
    console.log('Spectre WordPress Themes HMR update')
  })
}
