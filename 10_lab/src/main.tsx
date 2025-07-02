import {createRoot} from 'react-dom/client'
import {App} from './components/App'
import {CanvasController} from './controllers/CanvasController'
import {ShapeController} from './controllers/ShapeController'
import {CanvasModel} from './models/CanvasModel'

const root = document.getElementById('root')

const model = new CanvasModel()
if (root) {
	createRoot(root).render(
		<div style={{width: '100%', height: '100%'}}>
			<div style={{display: 'flex', gap: 10, width: '100%', height: '100%'}}>
				<App model={model} canvasController={new CanvasController(model)} shapeController={new ShapeController(model)}/>
			</div>
		</div>,
	)
}