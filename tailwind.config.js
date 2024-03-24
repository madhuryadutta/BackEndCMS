// tailwind.config.js

module.exports = {
  mode: 'jit',
  purge: ['./src/**/*.{js,jsx,ts,tsx}', './public/index.html'],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        primary: '#2B6CB0', // Corporate primary color
        secondary: '#718096', // Secondary color for text and borders
        accent: '#4A5568', // Accent color for buttons and highlights
        success: '#38A169', // Success color for positive actions
        error: '#E53E3E', // Error color for negative actions
        warning: '#D97706', // Warning color for alerts
        info: '#4299E1', // Information color for notifications
        dark: '#1A202C', // Dark mode background color
        light: '#F7FAFC', // Light mode background color
      },
      fontFamily: {
        sans: ['Roboto', 'Arial', 'sans-serif'], // Corporate font stack
      },
      fontSize: {
        xs: '0.75rem', // Smaller base font size
      },
      boxShadow: {
        sm: '0 1px 2px 0 rgba(0, 0, 0, 0.05)', // Small shadow for cards and buttons
        DEFAULT: '0 2px 4px 0 rgba(0, 0, 0, 0.1)', // Default shadow for containers
        md: '0 4px 6px -1px rgba(0, 0, 0, 0.1)', // Medium shadow for modal dialogs
        lg: '0 8px 10px -4px rgba(0, 0, 0, 0.1)', // Large shadow for dropdowns and modals
        xl: '0 12px 16px -6px rgba(0, 0, 0, 0.1)', // Extra large shadow for panels and cards
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
};
