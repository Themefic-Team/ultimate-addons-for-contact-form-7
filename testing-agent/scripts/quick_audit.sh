#!/bin/bash
# ==============================================================================
# Tourfic Quick Audit Helper Script
# Locates baseline commit and inspects all changes pushed after that baseline.
# ==============================================================================

BASELINE_TEXT="2.23.5"

echo "=========================================================="
echo "🔍 Searching for baseline commit: $BASELINE_TEXT..."
echo "=========================================================="

# Find commit containing the baseline release text
BASELINE_HASH=$(git log --grep="$BASELINE_TEXT" -n 1 --format="%h" 2>/dev/null)

if [ -z "$BASELINE_HASH" ]; then
    # Try git tags
    BASELINE_HASH=$(git rev-list -n 1 "$BASELINE_TEXT" 2>/dev/null)
fi

if [ -z "$BASELINE_HASH" ]; then
    echo "⚠️ Warning: Could not find commit matching '$BASELINE_TEXT'. Showing last 5 commits instead:"
    git log --oneline -n 5
    exit 1
fi

echo "✅ Baseline commit found: $BASELINE_HASH"
echo ""
echo "--- 📝 Commits since baseline ---"
git log ${BASELINE_HASH}..HEAD --pretty=format:"%h | %an | %ad | %s" --date=short
echo ""
echo ""

echo "--- 📂 Files Modified / Added ---"
git diff --stat ${BASELINE_HASH}..HEAD
echo ""

echo "--- 🧪 Running PHP Syntax Check on Changed PHP Files ---"
CHANGED_PHP_FILES=$(git diff --name-only ${BASELINE_HASH}..HEAD | grep "\.php$")

if [ -z "$CHANGED_PHP_FILES" ]; then
    echo "No PHP files modified in this change set."
else
    for file in $CHANGED_PHP_FILES; do
        if [ -f "$file" ]; then
            php -l "$file"
        fi
    done
fi

echo "=========================================================="
echo "Audit check complete. Antigravity can now generate AUDIT_REPORT.md."
echo "=========================================================="
