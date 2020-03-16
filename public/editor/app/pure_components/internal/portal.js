var ContextProvider = function () {};

ContextProvider.prototype.getChildContext = function () {
	return this.props.context;
};
ContextProvider.prototype.render = function (props) {
	return props.children;
};

function renderSubtreeIntoContainer(parentComponent, vnode, container, callback) {
	var wrap = preact.h(ContextProvider, { context: parentComponent.context }, vnode);
	var renderContainer = preact.render(wrap, container);
}

function Portal(props) {
	renderSubtreeIntoContainer(this, props.vnode, props.container);
}

function createPortal(vnode, container) {
	return preact.h(Portal, { vnode: vnode, container: container });
}

exports.Portal = Portal;
exports.createPortal = createPortal;
