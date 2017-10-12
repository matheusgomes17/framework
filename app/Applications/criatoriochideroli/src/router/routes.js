import { routes as app } from '../modules/app'
import { routes as auth } from '../modules/auth'

const root = [
    {path: '/', redirect: {name: 'app.home'}}
]

export default [...root, ...app, ...auth]
