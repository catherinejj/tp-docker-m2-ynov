import { createRoot } from 'react-dom/client'
import App from './App.jsx'
import './index.css' // ok to keep; it's what makes the dark bg

createRoot(document.getElementById('root')).render(<App />)