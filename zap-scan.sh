# #!/bin/bash
# # zap-scan.sh — Windows Git Bash + Docker Desktop compatible

# export MSYS_NO_PATHCONV=1

# echo "🔍 Starting OWASP ZAP full authenticated scan..."

# # Use explicit Windows-style path for Docker Desktop volume mounts
# ZAP_DIR="C:/Users/fv/Desktop/aura-studio-tuna-ecommerce/.zap"

# echo "📁 Using ZAP dir: $ZAP_DIR"

# # Verify auth.yaml exists before launching
# if [ ! -f "$ZAP_DIR/auth.yaml" ]; then
#   echo "❌ ERROR: auth.yaml not found at $ZAP_DIR/auth.yaml"
#   echo "   Make sure you created the .zap/auth.yaml file."
#   exit 1
# fi

# docker run --rm \
#   -v "$ZAP_DIR:/zap/wrk:rw" \
#   -v "$ZAP_DIR/scripts:/zap/scripts:ro" \
#   -v "$ZAP_DIR/reports:/zap/reports:rw" \
#   --network host \
#   ghcr.io/zaproxy/zaproxy:stable \
#   zap.sh -cmd \
#   -autorun /zap/wrk/auth.yaml

# echo "✅ Scan complete! Reports saved to .zap/reports/"
# echo "📄 Open: .zap/reports/zap-report-full.html"

#!/bin/bash
# zap-scan.sh — Run OWASP ZAP full authenticated scan

echo "🔍 Starting OWASP ZAP full authenticated scan..."

docker run --rm \
  -v "$(pwd)/.zap:/zap/wrk" \
  -v "$(pwd)/.zap/scripts:/zap/scripts" \
  -v "$(pwd)/.zap/reports:/zap/reports" \
  --network host \
  ghcr.io/zaproxy/zaproxy:stable \
  zap.sh -cmd \
    -autorun /zap/wrk/auth.yaml

echo "✅ Scan complete! Reports saved to .zap/reports/"
echo "📄 Open: .zap/reports/zap-report-full.html"