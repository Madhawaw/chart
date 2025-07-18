# Interactive Mind Mapping Software Selection Chart

A PHP-powered interactive mind mapping visualization that recreates the design thinking process flowchart. Each circular node is clickable and moves to the center when selected, displaying relevant connections and details.

## Features

- **Interactive Nodes**: Click any node to move it to the center
- **Dynamic Connections**: SVG lines connect nodes and update based on selection
- **Smooth Animations**: CSS transitions and transforms for fluid interactions
- **Responsive Design**: Works on desktop and mobile devices
- **PHP Backend**: Server-side data management and dynamic content generation
- **Keyboard Navigation**: Use number keys (1-5) or Escape to navigate
- **Export Functionality**: Export chart data as JSON

## Files Structure

```
├── index.php          # Main static HTML version
├── dynamic.php        # PHP-generated dynamic version
├── config.php         # PHP configuration and data management
├── style.css          # Styling and animations
├── script.js          # Interactive JavaScript functionality
└── README.md          # This documentation
```

## Installation & Usage

### Method 1: Simple Static Version
1. Open `index.php` in a web browser
2. No server setup required for basic functionality

### Method 2: PHP Dynamic Version
1. Set up a local PHP server:
   ```bash
   php -S localhost:8000
   ```
2. Navigate to `http://localhost:8000/dynamic.php`

### Method 3: Using Built-in PHP Server
```bash
# Start PHP development server
php -S localhost:8000

# Access the applications
# Static version: http://localhost:8000/index.php
# Dynamic version: http://localhost:8000/dynamic.php
# API endpoints: http://localhost:8000/config.php?action=get_nodes
```

## How It Works

### 1. Node Structure
Each node represents a phase in the design thinking process:
- **EMPATHIZE** (1): Understanding user needs
- **DEFINE** (2): Synthesizing problem statements  
- **IDEATE** (3): Generating creative solutions
- **PROTOTYPE** (4): Building testable ideas
- **TEST** (5): Validating with users

### 2. Interactive Behavior
- **Click a node**: Moves to center, shows details, repositions others
- **Click background**: Returns to original layout
- **Hover effects**: Visual feedback and scaling
- **Keyboard shortcuts**: Number keys for direct selection

### 3. PHP Integration
The `config.php` file provides:
- Centralized data management
- API endpoints for node data
- Server-side rendering functions
- Analytics and configuration

## API Endpoints

Access these via `config.php?action=`:

- `get_nodes` - Retrieve all node data
- `get_connections` - Get node connections
- `get_analytics` - Chart statistics
- `get_full_config` - Complete configuration

Example:
```
http://localhost:8000/config.php?action=get_nodes
```

## Customization

### Adding New Nodes
1. Update the `getNodeData()` function in `config.php`
2. Add corresponding CSS classes in `style.css`
3. Update connections in `getConnections()`

### Styling Changes
- Modify colors in the CSS gradient definitions
- Adjust animations in the transition properties
- Change positioning in the coordinate arrays

### Behavioral Changes
- Edit the JavaScript class `MindMapChart` in `script.js`
- Modify animation duration and easing functions
- Add new interaction patterns

## Browser Compatibility

- **Modern Browsers**: Chrome, Firefox, Safari, Edge
- **Mobile**: iOS Safari, Chrome Mobile
- **Requirements**: CSS3 transforms, SVG support, ES6 classes

## Technical Details

### CSS Features Used
- CSS Grid and Flexbox for layouts
- CSS Transforms for positioning
- CSS Transitions for animations
- CSS Custom Properties for theming
- SVG for connection lines

### JavaScript Features Used
- ES6 Classes and Modules
- Event Delegation
- DOM Manipulation
- SVG Programmatic Creation
- Local Storage (potential)

### PHP Features Used
- Static Class Methods
- JSON Encoding
- Template Rendering
- HTTP Response Headers
- Error Handling

## Performance Notes

- Animations use `transform` for GPU acceleration
- SVG lines are redrawn only when necessary
- Event listeners use delegation for efficiency
- CSS transitions are hardware-accelerated

## Future Enhancements

- [ ] Database integration for persistent data
- [ ] User authentication and personalization
- [ ] Custom node creation interface
- [ ] Export to various formats (PNG, SVG, PDF)
- [ ] Collaborative editing features
- [ ] Integration with project management tools

## License

This project is open source and available under the MIT License.

## Credits

Inspired by the Design Thinking process visualization and modern web interaction patterns.