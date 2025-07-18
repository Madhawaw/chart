<?php
/**
 * Mind Mapping Software Selection - PHP Configuration
 * This file contains the data structure and configuration for the interactive mind map
 */

class MindMapConfig {
    
    /**
     * Node data structure matching the JavaScript implementation
     */
    public static function getNodeData() {
        return [
            'empathize' => [
                'title' => 'EMPATHIZE',
                'icon' => '💬',
                'color' => '#A91D3A',
                'position' => 1,
                'details' => [
                    'Learn about the audience',
                    'Observe & Interview',
                    'Listen',
                    'Ask questions'
                ],
                'description' => 'Understanding user needs and pain points through research and observation.',
                'coordinates' => ['top' => '20%', 'left' => '15%']
            ],
            'define' => [
                'title' => 'DEFINE',
                'icon' => '🎯',
                'color' => '#F39C12',
                'position' => 2,
                'details' => [
                    'Define your scope',
                    'Look for patterns & insights',
                    'Question assumptions',
                    'Frame your P.O.V'
                ],
                'description' => 'Synthesizing observations into a clear problem statement.',
                'coordinates' => ['top' => '15%', 'right' => '20%']
            ],
            'ideate' => [
                'title' => 'IDEATE',
                'icon' => '🔄',
                'color' => '#E91E63',
                'position' => 3,
                'details' => [
                    'Come up with many solutions',
                    'Experiment',
                    'Co-create with team members',
                    'Brainstorm & select'
                ],
                'description' => 'Generating creative solutions and exploring possibilities.',
                'coordinates' => ['top' => '60%', 'right' => '15%']
            ],
            'prototype' => [
                'title' => 'PROTOTYPE',
                'icon' => '🔨',
                'color' => '#2980B9',
                'position' => 4,
                'details' => [
                    'Think big, Act Small, Fail Fast',
                    'Learn from users',
                    'Gather feedback',
                    'Refine'
                ],
                'description' => 'Building testable representations of ideas.',
                'coordinates' => ['bottom' => '15%', 'left' => '50%', 'transform' => 'translateX(-50%)']
            ],
            'test' => [
                'title' => 'TEST',
                'icon' => '⚙️',
                'color' => '#16A085',
                'position' => 5,
                'details' => [
                    'User testing and surveys',
                    'Evaluate',
                    'Gather Learnings',
                    'Iterate & Scale'
                ],
                'description' => 'Validating solutions with real users and iterating.',
                'coordinates' => ['top' => '60%', 'left' => '15%']
            ]
        ];
    }
    
    /**
     * Get connections between nodes
     */
    public static function getConnections() {
        return [
            ['empathize', 'define'],
            ['define', 'ideate'],
            ['ideate', 'prototype'],
            ['prototype', 'test'],
            ['test', 'empathize']
        ];
    }
    
    /**
     * Generate JSON data for JavaScript
     */
    public static function getJsonData() {
        return json_encode([
            'nodes' => self::getNodeData(),
            'connections' => self::getConnections(),
            'config' => [
                'title' => 'Mind Mapping Software Selection',
                'animation_duration' => 500,
                'node_radius' => 120,
                'center_radius' => 200
            ]
        ]);
    }
    
    /**
     * Render a single node
     */
    public static function renderNode($nodeKey, $nodeData) {
        $coordinates = $nodeData['coordinates'];
        $style = '';
        
        foreach ($coordinates as $property => $value) {
            $style .= "{$property}: {$value}; ";
        }
        
        return sprintf(
            '<div class="node %s" data-node="%s" data-position="%d" style="%s">
                <div class="node-icon">%s</div>
                <div class="node-text">%s</div>
                <div class="node-number">%d</div>
            </div>',
            $nodeKey,
            $nodeKey,
            $nodeData['position'],
            $style,
            $nodeData['icon'],
            $nodeData['title'],
            $nodeData['position']
        );
    }
    
    /**
     * Render node details
     */
    public static function renderNodeDetails($nodeKey, $nodeData) {
        $detailItems = '';
        foreach ($nodeData['details'] as $detail) {
            $detailItems .= sprintf('<div class="detail-item">%s</div>', htmlspecialchars($detail));
        }
        
        return sprintf(
            '<div class="details %s-details" data-for="%s">%s</div>',
            $nodeKey,
            $nodeKey,
            $detailItems
        );
    }
    
    /**
     * Get analytics data (example for backend integration)
     */
    public static function getAnalytics() {
        return [
            'total_nodes' => count(self::getNodeData()),
            'total_connections' => count(self::getConnections()),
            'last_updated' => date('Y-m-d H:i:s'),
            'version' => '1.0.0'
        ];
    }
}

// Example usage and API endpoints
if (isset($_GET['action'])) {
    header('Content-Type: application/json');
    
    switch ($_GET['action']) {
        case 'get_nodes':
            echo json_encode(MindMapConfig::getNodeData());
            break;
            
        case 'get_connections':
            echo json_encode(MindMapConfig::getConnections());
            break;
            
        case 'get_analytics':
            echo json_encode(MindMapConfig::getAnalytics());
            break;
            
        case 'get_full_config':
            echo MindMapConfig::getJsonData();
            break;
            
        default:
            http_response_code(404);
            echo json_encode(['error' => 'Invalid action']);
    }
    exit;
}
?>