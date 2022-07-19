<x-modal-confirm
    event-to-open-modal="custom-show-delete-comment"
    action-button="deleteButton"
    modal-title="Deactivate comment"
    modal-description="Are you sure you want to deactivate your comment? All of your data will be permanently removed. This action cannot be undone."
    action-trigger="deleteComment"
    modal-action="Delete comment"
    event-to-close-modal="delete-comment"
    display-notification-message="The comment was delete successfully!"
/>
