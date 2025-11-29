#!/bin/bash
# Almight Tracker - Censys IP Lookup Module
# Automatically searches captured IPs on Censys and displays location info
# Part of Almight Tracker v0.3

banner() {
printf '\n\e[1;96m╔════════════════════════════════════════════════════╗\e[0m\n'
printf '\e[1;96m║         CENSYS IP LOOKUP & LOCATION INFO          ║\e[0m\n'
printf '\e[1;96m╚════════════════════════════════════════════════════╝\e[0m\n\n'
}

extract_location_info() {
    local ip=$1
    
    # Extract location data from data.txt for this IP
    if [[ -f "data.txt" ]]; then
        # Look for the IP and extract relevant location info
        local ip_section=$(grep -A 20 "IP: $ip" data.txt 2>/dev/null)
        
        if [[ ! -z "$ip_section" ]]; then
            local country=$(echo "$ip_section" | grep -oP 'Country:\s*\K[^\\]+' | head -n1)
            local city=$(echo "$ip_section" | grep -oP 'City:\s*\K[^\\]+' | head -n1)
            local region=$(echo "$ip_section" | grep -oP 'Region name:\s*\K[^\\]+' | head -n1)
            local isp=$(echo "$ip_section" | grep -oP 'ISP Info:\s*\K[^\\]+' | head -n1)
            local lat=$(echo "$ip_section" | grep -oP 'Lat:\s*\K[^\\]+' | head -n1)
            local lon=$(echo "$ip_section" | grep -oP 'Long:\s*\K[^\\]+' | head -n1)
            
            printf "\e[1;92m   Location Details:\e[0m\n"
            [[ ! -z "$country" ]] && printf "   \e[1;77m├─ Country:\e[0m %s\n" "$country"
            [[ ! -z "$region" ]] && printf "   \e[1;77m├─ Region:\e[0m %s\n" "$region"
            [[ ! -z "$city" ]] && printf "   \e[1;77m├─ City:\e[0m %s\n" "$city"
            [[ ! -z "$isp" ]] && printf "   \e[1;77m├─ ISP:\e[0m %s\n" "$isp"
            [[ ! -z "$lat" && ! -z "$lon" ]] && printf "   \e[1;77m└─ Coordinates:\e[0m %s, %s\n" "$lat" "$lon"
        else
            printf "   \e[1;90m└─ No location data available\e[0m\n"
        fi
    fi
}

process_ips() {
    local captured_file="captured_ips.txt"
    
    if [[ ! -f "$captured_file" ]]; then
        printf "\e[1;31m[!] No captured IPs found in %s\e[0m\n" "$captured_file"
        return
    fi
    
    # Count total IPs
    local total_ips=$(wc -l < "$captured_file")
    
    if [[ $total_ips -eq 0 ]]; then
        printf "\e[1;33m[!] No IPs captured during this session\e[0m\n"
        return
    fi
    
    printf "\e[1;93m[*] Found %s captured IP(s)\e[0m\n\n" "$total_ips"
    
    local counter=1
    
    # Read each IP from the file
    while IFS= read -r ip; do
        # Skip empty lines
        [[ -z "$ip" ]] && continue
        
        printf "\e[1;96m━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\e[0m\n"
        printf "\e[1;94m[%s/%s]\e[0m \e[1;77mIP Address:\e[0m \e[1;93m%s\e[0m\n\n" "$counter" "$total_ips" "$ip"
        
        # Extract and display location info
        extract_location_info "$ip"
        
        # Generate Censys search link
        local censys_link="https://search.censys.io/hosts/${ip}"
        printf "\n\e[1;92m   Censys Search Link:\e[0m\n"
        printf "   \e[1;36m└─ %s\e[0m\n\n" "$censys_link"
        
        # Optionally open in browser (commented out by default)
        # Uncomment the following lines to auto-open links
        # if command -v xdg-open > /dev/null 2>&1; then
        #     xdg-open "$censys_link" > /dev/null 2>&1 &
        # elif command -v open > /dev/null 2>&1; then
        #     open "$censys_link" > /dev/null 2>&1 &
        # fi
        
        ((counter++))
    done < "$captured_file"
    
    printf "\e[1;96m━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\e[0m\n\n"
    printf "\e[1;92m[✓] All Censys links generated successfully!\e[0m\n"
    printf "\e[1;93m[*] Copy the links above to search IPs on Censys\e[0m\n\n"
}

# Main execution
banner
process_ips
