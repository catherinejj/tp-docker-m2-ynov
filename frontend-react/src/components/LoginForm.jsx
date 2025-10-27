import { useState } from 'react'

export default function LoginForm() {
  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')
  const [status, setStatus] = useState('')

  const onSubmit = async (e) => {
    e.preventDefault()
    try {
      const res = await fetch('/api/login', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email, password })
      })
      setStatus(res.ok ? '✅ Connecté' : '❌ Échec')
    } catch {
      setStatus('❌ API inaccessible')
    }
  }

  return (
    <form onSubmit={onSubmit} style={{display:'grid', gap:12, maxWidth:320}}>
      <input placeholder="Email" value={email} onChange={e=>setEmail(e.target.value)} />
      <input type="password" placeholder="Mot de passe" value={password} onChange={e=>setPassword(e.target.value)} />
      <button>Se connecter</button>
      <div>{status}</div>
    </form>
  )
}