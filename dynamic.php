<?php
require_once 'config.php';

$nodeData = MindMapConfig::getNodeData();
$connections = MindMapConfig::getConnections();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Mind Mapping Software Selection - Dynamic PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="chart-container" id="chartContainer">
            <div class="center-title">
                <h2>Mind Mapping Software Selection</h2>
                <p><small>Generated dynamically with PHP</small></p>
            </div>
            
            <!-- Dynamically generated nodes -->
            <?php foreach ($nodeData as $nodeKey => $node): ?>
                <?php echo MindMapConfig::renderNode($nodeKey, $node); ?>
            <?php endforeach; ?>
            
            <!-- Connection lines -->
            <svg class="connections" id="connections">
                <!-- Lines will be drawn by JavaScript -->
            </svg>
            
            <!-- Dynamically generated detail boxes -->
            <?php foreach ($nodeData as $nodeKey => $node): ?>
                <?php echo MindMapConfig::renderNodeDetails($nodeKey, $node); ?>
            <?php endforeach; ?>
        </div>
        
        <!-- PHP-generated data for JavaScript -->
        <script>
            window.mindMapData = <?php echo MindMapConfig::getJsonData(); ?>;
            window.analytics = <?php echo json_encode(MindMapConfig::getAnalytics()); ?>;
        </script>
    </div>
    
    <!-- Info panel -->
    <div class="info-panel" id="infoPanel">
        <h3>Chart Information</h3>
        <div class="info-content">
            <p><strong>Total Nodes:</strong> <?php echo count($nodeData); ?></p>
            <p><strong>Total Connections:</strong> <?php echo count($connections); ?></p>
            <p><strong>Generated:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
            <p><strong>Version:</strong> <?php echo MindMapConfig::getAnalytics()['version']; ?></p>
        </div>
        <button onclick="toggleInfoPanel()" class="close-btn">×</button>
    </div>
    
    <!-- Control panel -->
    <div class="control-panel">
        <button onclick="resetChart()" class="control-btn">Reset Chart</button>
        <button onclick="toggleInfoPanel()" class="control-btn">Show Info</button>
        <button onclick="exportData()" class="control-btn">Export Data</button>
    </div>
    
    <script src="script.js"></script>
    <script>
        // Enhanced functionality for PHP version
        function toggleInfoPanel() {
            const panel = document.getElementById('infoPanel');
            panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
        }
        
        function resetChart() {
            if (window.mindMap) {
                window.mindMap.resetToOriginal();
            }
        }
        
        function exportData() {
            const data = {
                nodes: window.mindMapData.nodes,
                connections: window.mindMapData.connections,
                analytics: window.analytics,
                exported_at: new Date().toISOString()
            };
            
            const blob = new Blob([JSON.stringify(data, null, 2)], {type: 'application/json'});
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'mindmap_data.json';
            a.click();
            URL.revokeObjectURL(url);
        }
        
        // Store reference to mind map instance
        document.addEventListener('DOMContentLoaded', () => {
            window.mindMap = new MindMapChart();
            
            // Hide info panel initially
            document.getElementById('infoPanel').style.display = 'none';
            
            console.log('PHP-generated Mind Map loaded');
            console.log('Data:', window.mindMapData);
        });
    </script>
    
    <style>
        .info-panel {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            min-width: 250px;
        }
        
        .info-panel h3 {
            margin: 0 0 15px 0;
            color: #333;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 5px;
        }
        
        .info-content p {
            margin: 8px 0;
            color: #666;
            font-size: 14px;
        }
        
        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #999;
        }
        
        .close-btn:hover {
            color: #333;
        }
        
        .control-panel {
            position: fixed;
            bottom: 20px;
            left: 20px;
            display: flex;
            gap: 10px;
            z-index: 1000;
        }
        
        .control-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .control-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        
        .center-title p {
            margin: 10px 0 0 0;
            color: #666;
            font-size: 12px;
        }
    </style>
</body>
</html>