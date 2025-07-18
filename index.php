<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Mind Mapping Software Selection</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="chart-container" id="chartContainer">
            <div class="center-title">
                <h2>Mind Mapping Software Selection</h2>
            </div>
            
            <!-- Main nodes -->
            <div class="node empathize active" data-node="empathize" data-position="1">
                <div class="node-icon">💬</div>
                <div class="node-text">EMPATHIZE</div>
                <div class="node-number">1</div>
            </div>
            
            <div class="node define" data-node="define" data-position="2">
                <div class="node-icon">🎯</div>
                <div class="node-text">DEFINE</div>
                <div class="node-number">2</div>
            </div>
            
            <div class="node ideate" data-node="ideate" data-position="3">
                <div class="node-icon">🔄</div>
                <div class="node-text">IDEATE</div>
                <div class="node-number">3</div>
            </div>
            
            <div class="node prototype" data-node="prototype" data-position="4">
                <div class="node-icon">🔨</div>
                <div class="node-text">PROTOTYPE</div>
                <div class="node-number">4</div>
            </div>
            
            <div class="node test" data-node="test" data-position="5">
                <div class="node-icon">⚙️</div>
                <div class="node-text">TEST</div>
                <div class="node-number">5</div>
            </div>
            
            <!-- Connection lines -->
            <svg class="connections" id="connections">
                <!-- Lines will be drawn by JavaScript -->
            </svg>
            
            <!-- Detail boxes for each node -->
            <div class="details empathize-details" data-for="empathize">
                <div class="detail-item">Learn about the audience</div>
                <div class="detail-item">Observe & Interview</div>
                <div class="detail-item">Listen</div>
                <div class="detail-item">Ask questions</div>
            </div>
            
            <div class="details define-details" data-for="define">
                <div class="detail-item">Define your scope</div>
                <div class="detail-item">Look for patterns & insights</div>
                <div class="detail-item">Question assumptions</div>
                <div class="detail-item">Frame your P.O.V</div>
            </div>
            
            <div class="details ideate-details" data-for="ideate">
                <div class="detail-item">Come up with many solutions</div>
                <div class="detail-item">Experiment</div>
                <div class="detail-item">Co-create with team members</div>
                <div class="detail-item">Brainstorm & select</div>
            </div>
            
            <div class="details prototype-details" data-for="prototype">
                <div class="detail-item">Think big, Act Small, Fail Fast</div>
                <div class="detail-item">Learn from users</div>
                <div class="detail-item">Gather feedback</div>
                <div class="detail-item">Refine</div>
            </div>
            
            <div class="details test-details" data-for="test">
                <div class="detail-item">User testing and surveys</div>
                <div class="detail-item">Evaluate</div>
                <div class="detail-item">Gather Learnings</div>
                <div class="detail-item">Iterate & Scale</div>
            </div>
        </div>
    </div>
    
    <script src="script.js"></script>
</body>
</html>