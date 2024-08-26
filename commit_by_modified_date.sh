#!/bin/bash

# Function to commit a file with a specific date
commit_file() {
    local file="$1"
    local date="$2"

    # Check if the file exists and is not in .git directory
    if [ -e "$file" ] && [[ "$file" != *.git/* ]]; then
        git add "$file"
        GIT_COMMITTER_DATE="$date" git commit --date="$date" -m "Committing $file based on last modified time $date"
        echo "Committed $file with date $date"
    fi
}

# Root directory of the project
project_root="."

# Find all files (excluding those in .git directory) and commit them
find "$project_root" -type f ! -path '*/.git/*' | while read -r file; do
    # Get the last modified date of the file in the format required by git
    last_modified_date=$(date -r "$file" +"%a %b %d %H:%M:%S %Y %z")
    commit_file "$file" "$last_modified_date"
done

# Find all directories (excluding those in .git directory) and commit them
find "$project_root" -type d ! -path '*/.git/*' | while read -r dir; do
    # Get the last modified date of the directory (using any file in the directory)
    # Here we use the latest modified file in the directory
    latest_file=$(find "$dir" -type f -print0 | xargs -0 stat --format='%Y %n' | sort -n | tail -n 1 | cut -d ' ' -f 2-)
    if [ -n "$latest_file" ]; then
        last_modified_date=$(date -r "$latest_file" +"%a %b %d %H:%M:%S %Y %z")
        commit_file "$dir" "$last_modified_date"
    fi
done
