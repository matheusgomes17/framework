import { routes as app } from '../modules/app'
import { routes as auth } from '../modules/auth'

const root = [
    {path: '/', redirect: '/app'}
]

export default [...root, ...app, ...auth]
