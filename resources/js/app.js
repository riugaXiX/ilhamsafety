require('./bootstrap');

fetch('/api/get-decision-tree', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({data: yourDataHere})
})
.then(response => response.json())
.then(tree => {
    var nodes = new vis.DataSet();
    var edges = new vis.DataSet();

    function traverse(node, index) {
        nodes.add({id: index, label: node.label, title: 'Type: ' + node.type});
        if (node.children) {
            node.children.forEach((child, idx) => {
                var childIndex = index * 10 + idx;
                edges.add({from: index, to: childIndex});
                traverse(child.child, childIndex);
            });
        }
    }

    traverse(tree, 1);

    var container = document.getElementById('network');
    var data = {nodes: nodes, edges: edges};
    var options = {};
    var network = new vis.Network(container, data, options);
})
.catch(error => console.error('Error:', error));