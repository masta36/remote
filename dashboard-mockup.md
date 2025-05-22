# UDI Submission Dashboard - Design Mockup

## Overview

This document presents a mockup design for the UDI (Unique Device Identification) submission dashboard. The dashboard is designed to provide users with a comprehensive view of UDI submissions worldwide and offer quick access to necessary tools for managing these submissions.

## Dashboard Components

### 1. Header Section
- **Logo and Title**: UDI Submission Dashboard branding
- **User Controls**: Notifications bell and user profile access
- **Global Search Bar**: Search functionality for finding submissions by ID, product name, manufacturer, etc.

### 2. Status Filters
- Filter tabs to quickly view submissions by status:
  - All
  - Draft
  - Submitted
  - Under Review
  - Approved
  - Rejected
  - Needs Info
- View toggle (List/Grid) for different visualization preferences

### 3. Status Summary Cards
Four cards displaying counts and trends for key submission statuses:
- **Draft**: Submissions in preparation
- **Submitted**: Submissions awaiting initial review
- **Under Review**: Submissions currently being evaluated
- **Approved**: Successfully completed submissions

Each card shows:
- Current count
- Weekly trend (increase/decrease)

### 4. Main Content Area
Split into two sections:

#### 4.1 Submissions List
- Tabular view of recent submissions with columns for:
  - Submission ID
  - Product Name
  - Manufacturer
  - Region
  - Submission Date
  - Status (with color-coded badges)
  - Actions (View, Edit, Submit, Resubmit based on status)
- Pagination controls for navigating through submissions

#### 4.2 Tools & Actions Panel
- **Tools Grid**: Quick access to common tools
  - New Submission
  - Reports
  - Bulk Upload
  - Templates
- **Quick Actions**: Prominent buttons for common tasks
  - Create New Submission
  - Import from CSV
  - Export Current View

### 5. Global Submission Overview
- World map visualization showing submission density by region
- Provides geographical context for submission activity

### 6. Notifications Panel
- Accessible via bell icon in header
- Displays recent activity requiring attention
- Shows submission status changes and items needing action

## Status Categories

The dashboard recognizes the following submission statuses:

1. **Draft**: Submissions in preparation, not yet submitted to regulatory bodies
2. **Submitted**: Completed submissions awaiting initial review
3. **Under Review**: Submissions currently being evaluated by regulatory authorities
4. **Approved**: Submissions that have received regulatory approval
5. **Rejected**: Submissions that were not approved
6. **Needs Info**: Submissions requiring additional information or clarification

## User Tools

The dashboard provides access to the following tools:

1. **New Submission**: Create a new UDI submission from scratch
2. **Reports**: Generate reports on submission status, trends, and metrics
3. **Bulk Upload**: Upload multiple submissions simultaneously
4. **Templates**: Access and manage submission templates for faster creation
5. **Import/Export**: Tools for importing data from CSV and exporting current views
6. **Search & Filter**: Tools for finding specific submissions
7. **Edit & Resubmit**: Tools for modifying and resubmitting entries

## Responsive Design

The dashboard is designed to be responsive, with layout adjustments for different screen sizes:
- On smaller screens, status cards and tools grid collapse to fewer columns
- Main content area switches from side-by-side to stacked layout on mobile devices

## Color Coding

Status badges use intuitive color coding:
- **Draft**: Gray
- **Submitted**: Blue
- **Under Review**: Yellow
- **Approved**: Green
- **Rejected**: Red
- **Needs Info**: Purple

## Next Steps

This mockup represents the initial layout design. Subsequent development tasks include:
- Implementation of the dashboard UI (PRO-BD9A773C)
- Integration of status summary functionality (PRO-461D6A03)
- Development of user tools section (PRO-4ACA5314)
- Implementation of status filters (PRO-0C02D0C3)
- Enabling search functionality (PRO-39EB4F12)
- Adding submission details popup (PRO-4AAF3E29)
- Testing and bug fixing (PRO-AD484463)

