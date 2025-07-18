class MindMapChart {
    constructor() {
        this.nodes = document.querySelectorAll('.node');
        this.chartContainer = document.getElementById('chartContainer');
        this.connections = document.getElementById('connections');
        this.activeNode = null;
        this.originalPositions = new Map();
        
        this.init();
    }
    
    init() {
        // Store original positions
        this.nodes.forEach(node => {
            const rect = node.getBoundingClientRect();
            const containerRect = this.chartContainer.getBoundingClientRect();
            this.originalPositions.set(node.dataset.node, {
                top: node.style.top || getComputedStyle(node).top,
                left: node.style.left || getComputedStyle(node).left,
                right: node.style.right || getComputedStyle(node).right,
                bottom: node.style.bottom || getComputedStyle(node).bottom,
                transform: node.style.transform || getComputedStyle(node).transform
            });
        });
        
        // Add click event listeners
        this.nodes.forEach(node => {
            node.addEventListener('click', (e) => {
                e.preventDefault();
                this.handleNodeClick(node);
            });
        });
        
        // Add click outside to reset
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.node') && !e.target.closest('.details')) {
                this.resetToOriginal();
            }
        });
        
        // Draw initial connections
        this.drawConnections();
        
        // Handle window resize
        window.addEventListener('resize', () => {
            this.drawConnections();
        });
    }
    
    handleNodeClick(clickedNode) {
        const nodeType = clickedNode.dataset.node;
        
        // If same node is clicked, reset
        if (this.activeNode === nodeType) {
            this.resetToOriginal();
            return;
        }
        
        // Reset previous state
        this.resetToOriginal();
        
        // Set new active node
        this.activeNode = nodeType;
        this.chartContainer.classList.add('node-active');
        
        // Move clicked node to center
        this.moveNodeToCenter(clickedNode);
        
        // Show relevant details
        this.showNodeDetails(nodeType);
        
        // Update connections
        this.updateConnections(clickedNode);
        
        // Position other nodes around the center
        this.repositionOtherNodes(clickedNode);
    }
    
    moveNodeToCenter(node) {
        node.classList.add('center', 'active');
        
        // Remove original positioning classes
        const position = this.originalPositions.get(node.dataset.node);
        node.style.top = '';
        node.style.left = '';
        node.style.right = '';
        node.style.bottom = '';
    }
    
    showNodeDetails(nodeType) {
        // Hide all details first
        document.querySelectorAll('.details').forEach(detail => {
            detail.classList.remove('show');
        });
        
        // Show relevant details
        const relevantDetails = document.querySelector(`.${nodeType}-details`);
        if (relevantDetails) {
            setTimeout(() => {
                relevantDetails.classList.add('show');
            }, 300);
        }
    }
    
    repositionOtherNodes(centerNode) {
        const otherNodes = Array.from(this.nodes).filter(node => node !== centerNode);
        const centerX = window.innerWidth / 2;
        const centerY = window.innerHeight / 2;
        const radius = 200;
        
        otherNodes.forEach((node, index) => {
            const angle = (index * (360 / otherNodes.length)) * (Math.PI / 180);
            const x = centerX + radius * Math.cos(angle);
            const y = centerY + radius * Math.sin(angle);
            
            // Remove center class if it has one
            node.classList.remove('center', 'active');
            
            // Position around center
            node.style.position = 'absolute';
            node.style.left = `${x - 60}px`; // 60 is half of node width
            node.style.top = `${y - 60}px`;  // 60 is half of node height
            node.style.right = 'auto';
            node.style.bottom = 'auto';
            node.style.transform = 'none';
        });
    }
    
    resetToOriginal() {
        this.activeNode = null;
        this.chartContainer.classList.remove('node-active');
        
        // Reset all nodes to original positions
        this.nodes.forEach(node => {
            const original = this.originalPositions.get(node.dataset.node);
            node.classList.remove('center', 'active');
            
            // Restore original positioning
            node.style.top = original.top;
            node.style.left = original.left;
            node.style.right = original.right;
            node.style.bottom = original.bottom;
            node.style.transform = original.transform;
        });
        
        // Hide all details
        document.querySelectorAll('.details').forEach(detail => {
            detail.classList.remove('show');
        });
        
        // Reset connections
        this.drawConnections();
    }
    
    drawConnections() {
        // Clear existing connections
        this.connections.innerHTML = '';
        
        if (this.activeNode) {
            // Draw connections from center to surrounding nodes
            this.drawCenterConnections();
        } else {
            // Draw original web connections
            this.drawOriginalConnections();
        }
    }
    
    drawCenterConnections() {
        const centerNode = document.querySelector(`.node[data-node="${this.activeNode}"]`);
        const otherNodes = Array.from(this.nodes).filter(node => node !== centerNode);
        
        const centerRect = centerNode.getBoundingClientRect();
        const containerRect = this.chartContainer.getBoundingClientRect();
        
        const centerX = centerRect.left + centerRect.width / 2 - containerRect.left;
        const centerY = centerRect.top + centerRect.height / 2 - containerRect.top;
        
        otherNodes.forEach(node => {
            const nodeRect = node.getBoundingClientRect();
            const nodeX = nodeRect.left + nodeRect.width / 2 - containerRect.left;
            const nodeY = nodeRect.top + nodeRect.height / 2 - containerRect.top;
            
            this.createConnectionLine(centerX, centerY, nodeX, nodeY, true);
        });
    }
    
    drawOriginalConnections() {
        // Define connections between nodes (like in the original image)
        const connections = [
            ['empathize', 'define'],
            ['define', 'ideate'],
            ['ideate', 'prototype'],
            ['prototype', 'test'],
            ['test', 'empathize']
        ];
        
        connections.forEach(([from, to]) => {
            const fromNode = document.querySelector(`.node[data-node="${from}"]`);
            const toNode = document.querySelector(`.node[data-node="${to}"]`);
            
            if (fromNode && toNode) {
                const fromRect = fromNode.getBoundingClientRect();
                const toRect = toNode.getBoundingClientRect();
                const containerRect = this.chartContainer.getBoundingClientRect();
                
                const fromX = fromRect.left + fromRect.width / 2 - containerRect.left;
                const fromY = fromRect.top + fromRect.height / 2 - containerRect.top;
                const toX = toRect.left + toRect.width / 2 - containerRect.left;
                const toY = toRect.top + toRect.height / 2 - containerRect.top;
                
                this.createConnectionLine(fromX, fromY, toX, toY, false);
            }
        });
    }
    
    createConnectionLine(x1, y1, x2, y2, isActive = false) {
        const line = document.createElementNS('http://www.w3.org/2000/svg', 'line');
        line.setAttribute('x1', x1);
        line.setAttribute('y1', y1);
        line.setAttribute('x2', x2);
        line.setAttribute('y2', y2);
        line.classList.add('connection-line');
        
        if (isActive) {
            line.classList.add('active');
        }
        
        this.connections.appendChild(line);
    }
    
    updateConnections(centerNode) {
        setTimeout(() => {
            this.drawConnections();
        }, 100);
    }
}

// PHP-like data structure for node information
const nodeData = {
    empathize: {
        title: "EMPATHIZE",
        icon: "💬",
        color: "#A91D3A",
        details: [
            "Learn about the audience",
            "Observe & Interview", 
            "Listen",
            "Ask questions"
        ],
        description: "Understanding user needs and pain points through research and observation."
    },
    define: {
        title: "DEFINE",
        icon: "🎯", 
        color: "#F39C12",
        details: [
            "Define your scope",
            "Look for patterns & insights",
            "Question assumptions", 
            "Frame your P.O.V"
        ],
        description: "Synthesizing observations into a clear problem statement."
    },
    ideate: {
        title: "IDEATE",
        icon: "🔄",
        color: "#E91E63", 
        details: [
            "Come up with many solutions",
            "Experiment",
            "Co-create with team members",
            "Brainstorm & select"
        ],
        description: "Generating creative solutions and exploring possibilities."
    },
    prototype: {
        title: "PROTOTYPE", 
        icon: "🔨",
        color: "#2980B9",
        details: [
            "Think big, Act Small, Fail Fast",
            "Learn from users",
            "Gather feedback",
            "Refine"
        ],
        description: "Building testable representations of ideas."
    },
    test: {
        title: "TEST",
        icon: "⚙️",
        color: "#16A085",
        details: [
            "User testing and surveys", 
            "Evaluate",
            "Gather Learnings",
            "Iterate & Scale"
        ],
        description: "Validating solutions with real users and iterating."
    }
};

// Initialize the mind map when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    const mindMap = new MindMapChart();
    
    // Add some interactive features
    document.querySelectorAll('.detail-item').forEach(item => {
        item.addEventListener('click', (e) => {
            e.stopPropagation();
            item.style.transform = 'scale(1.05)';
            setTimeout(() => {
                item.style.transform = '';
            }, 200);
        });
    });
    
    // Add keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            mindMap.resetToOriginal();
        }
        
        // Number keys to select nodes
        const nodeNumbers = {'1': 'empathize', '2': 'define', '3': 'ideate', '4': 'prototype', '5': 'test'};
        if (nodeNumbers[e.key]) {
            const node = document.querySelector(`.node[data-node="${nodeNumbers[e.key]}"]`);
            if (node) {
                mindMap.handleNodeClick(node);
            }
        }
    });
    
    console.log('Mind Mapping Software Selection Chart Initialized');
    console.log('Available nodes:', Object.keys(nodeData));
});