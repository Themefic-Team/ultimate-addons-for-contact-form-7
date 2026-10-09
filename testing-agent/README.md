# 🤖 Tourfic Code Audit & QA Testing Agent

Welcome to the **Testing Agent** for Tourfic. This agent is designed to automatically audit new code pushed by your developers against your last release/commit comment (e.g. `= 2.23.5 – Sep 10, 2026 =`), verify organization standards, check for fatal errors and warnings, detect potential conflicts with existing Tourfic features, and generate a professional `RELEASE_AUDIT_REPORT.md` file with manual QA checklists.

---

## ⚡ Autonomous Execution (No Confirmations Needed)
This agent is pre-configured with **Full Autonomous Test Access**:
- The AI agent will **NOT** stop to prompt you for confirmation to run commands (`git log`, `git diff`, `php -l`, search tools, etc.) during testing.
- It will execute the entire audit from start to finish on its own, then notify you with the final `RELEASE_AUDIT_REPORT.md`.
- *Security Guarantee:* Autonomous access is strictly constrained to read-only inspection, running syntax/test commands, and writing the report. It will never overwrite or modify core plugin source files.

---

## 📁 What is Inside This Folder?

- **`AGENT_INSTRUCTIONS.md`**: Master instructions for Antigravity with full autonomous execution directives.
- **`AGENTS.md`**: Antigravity workspace integration file (copy to plugin root for zero-setup detection).
- **`config.json`**: Central configuration defining baseline (`= 2.23.5 – Sep 10, 2026 =`), autonomous access flags, and paths.
- **`templates/AUDIT_REPORT_TEMPLATE.md`**: Standardized markdown report template.
- **`checklists/standards_and_security.md`**: Org rules: Nonces, sanitization, output escaping, `$wpdb->prepare`, removing debug logs, textdomains.
- **`checklists/conflict_and_regression.md`**: Tourfic core features conflict matrix (Hotels, Tours, Apartments, WooCommerce checkout, cart metadata, pricing engine).
- **`scripts/quick_audit.sh`**: Quick terminal helper script.

---

## 🚀 How to Use

### Step 1: Copy this folder into your Plugin
Copy the whole `testing-agent` folder into your working plugin directory:
```bash
tourfic/
├── testing-agent/           <--- Paste folder here
│   ├── AGENT_INSTRUCTIONS.md
│   ├── AGENTS.md
│   ├── config.json
│   ├── templates/
│   ├── checklists/
│   └── scripts/
├── inc/
├── templates/
├── tourfic.php
└── readme.txt
```

*(Tip: You can also copy `AGENTS.md` directly into the root of `tourfic/` so Antigravity loads it automatically for any chat session).*

### Step 2: Open Antigravity and Prompt the Agent
Whenever your developer pushes code, open your `tourfic` project in Antigravity and paste this command:

> **"Follow the instructions in testing-agent/AGENT_INSTRUCTIONS.md. My previous release comment was '= 2.23.5 – Sep 10, 2026 ='. You have full autonomous access to run all audit and test commands without asking for confirmation. Audit all changes pushed after that baseline, check for fatal errors or conflicts with existing features, and generate RELEASE_AUDIT_REPORT.md."**

The agent will run all checks without interrupting you and deliver your complete `RELEASE_AUDIT_REPORT.md`!
