// generate-theme-json.js
// Node.js script to parse SCSS tokens and generate theme.json for WordPress theme

const fs = require("fs");
const path = require("path");

const scssFile = path.join(__dirname, "src/sass/theme/_tokens.scss");
const themeJsonFile = path.join(__dirname, "theme.json");

// Parse CSS custom properties from :root block
function parseCssVariables(scssContent) {
  const rootBlockMatch = scssContent.match(/:root\s*{([\s\S]*?)}/);
  if (!rootBlockMatch) return {};
  const rootContent = rootBlockMatch[1];
  const varRegex = /--([\w-]+):\s*([^;]+);/g;
  const tokens = {};
  let match;
  while ((match = varRegex.exec(rootContent)) !== null) {
    tokens[match[1]] = match[2].trim();
  }
  return tokens;
}

// Map CSS variables to theme.json structure
function buildThemeJson(tokens) {
  // Helper to resolve hsl(var(--hsl-*)) to actual hsl value
  function resolveColorValue(value, key) {
    const hslVarMatch = value.match(/^hsl\(var\(--([\w-]+)\)\)$/);
    if (hslVarMatch) {
      const hslKey = hslVarMatch[1];
      if (tokens[hslKey]) {
        return `hsl(${tokens[hslKey]})`;
      }
    }
    return value;
  }

  // Map color variables (starts with col-, but not alpha variants)
  const colors = Object.entries(tokens)
    .filter(([key]) => key.startsWith("col-") && !/-\d+$/.test(key))
    .map(([key, value]) => {
      const slug = key.replace("col-", "");
      const name = slug
        .split("-")
        .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
        .join(" ");
      return {
        name: name,
        slug: slug,
        color: resolveColorValue(value, key),
      };
    });

  // Map font size variables (starts with fs-)
  const fontSizes = Object.entries(tokens)
    .filter(([key]) => key.startsWith("fs-"))
    .map(([key, value]) => {
      const slug = key.replace("fs-", "");
      return {
        name: slug,
        slug: slug,
        size: value,
      };
    });

  // Extract font families
  const fontFamilies = [
    {
      slug: "heading",
      name: "Heading",
      fontFamily: tokens["ff-heading"] || "serif",
    },
    {
      slug: "body",
      name: "Body",
      fontFamily: tokens["ff-body"] || "sans-serif",
    },
  ].filter((f) => f.fontFamily);

  return {
    version: 2,
    settings: {
      appearanceTools: true,
      color: {
        palette: colors,
        custom: false,
        defaultPalette: false,
      },
      typography: {
        fontFamilies: fontFamilies,
        fontSizes: fontSizes,
      },
    },
    styles: {
      typography: {
        fontFamily: "var(--ff-body)",
        lineHeight: "var(--lh-100)",
      },
      elements: {
        heading: {
          typography: {
            fontFamily: "var(--ff-heading)",
            fontWeight: "600",
            lineHeight: "var(--lh-600)",
          },
        },
      },
    },
  };
}

function main() {
  if (!fs.existsSync(scssFile)) {
    console.error("SCSS tokens file not found:", scssFile);
    process.exit(1);
  }
  const scssContent = fs.readFileSync(scssFile, "utf8");
  const tokens = parseCssVariables(scssContent);
  const themeJson = buildThemeJson(tokens);
  fs.writeFileSync(themeJsonFile, JSON.stringify(themeJson, null, 2));
  console.log("theme.json generated successfully from SCSS tokens.");
}

main();
