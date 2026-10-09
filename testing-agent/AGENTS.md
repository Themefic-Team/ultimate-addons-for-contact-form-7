# Antigravity Workspace Configuration for Tourfic Code Audits

## ⚡ Autonomous Execution Grant (Audit & Testing Only)
- The agent has **FULL AUTONOMOUS PRE-APPROVED ACCESS** to inspect the repository, read files, execute git commands (`git log`, `git diff`, `git show`), run syntax checks (`php -l`), and execute test suites.
- **DO NOT pause to prompt the user for confirmation** during the audit workflow. Execute all steps proactively and autonomously.
- Write the final `RELEASE_AUDIT_REPORT.md` directly upon completion.
- *Constraint:* This full access applies strictly to auditing and testing; do not modify core plugin source files unless explicitly requested.

## Audit Workflow Trigger
Whenever the user asks to review, audit, test, or check latest pushed code from the developer:
1. Refer to the instructions in `testing-agent/AGENT_INSTRUCTIONS.md`.
2. Compare all commits and changes against the release baseline `= 2.23.5 – Sep 10, 2026 =` (or the baseline configured in `testing-agent/config.json`).
3. Check for PHP syntax / fatal errors, verify Org & WordPress standards, detect potential feature conflicts in Tourfic, and compile manual QA steps.
4. Output the full audit findings as `RELEASE_AUDIT_REPORT.md` at the root of the plugin.
