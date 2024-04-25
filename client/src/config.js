opensupports_version = '4.11.0';

root = `/helpdesk`;
apiRoot = '/helpdesk/api';

projectId = window.location.pathname.match(/\/helpdesk\/projects\/(\d+)/)[1];
globalIndexPath = `/helpdesk/projects/${projectId}`;
globalHeaders = {
    'X-PROJECT-ID': projectId,
};
showLogs = true;
